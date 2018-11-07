<?php

namespace Freshcells\Cache\Tests\GeneratableKeyCache;

use Freshcells\Cache\GeneratableKeyCache\GeneratableKeyCachePool;
use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\Md5Generator;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class GeneratableKeyCachePoolExtendedTest extends \PHPUnit_Framework_TestCase
{
    public function testGetItemByVar()
    {
        $cache = $this->createCachePool();

        $keyVar      = new \stdClass();
        $keyVar->foo = ['baz' => 'bif'];

        $data = ['this is' => 'an array'];
        $item = $cache->getItemByVar($keyVar);
        $item->set($data);
        $cache->save($item);

        $itemFromCache = $cache->getItemByVar($keyVar);

        $this->assertEquals($data, $itemFromCache->get());
        $this->assertEquals('prefix192f4c8b50dec4af9feae3e6db20080f', $item->getKey());
        $this->assertEquals('prefix192f4c8b50dec4af9feae3e6db20080f', $itemFromCache->getKey());

        $itemDirect = $cache->getItem($item->getKey());
        $this->assertEquals($data, $itemDirect->get());
    }

    public function testGetItemsByVar()
    {
        $cache = $this->createCachePool();

        $keyVar      = new \stdClass();
        $keyVar->foo = ['baz' => 'bif'];

        $keyVar2 = ['baz' => 'bif', 'ping' => 'pong'];

        $data  = ['this is' => 'an array'];
        $data2 = 'String';
        $items = $cache->getItemsByVars([$keyVar, $keyVar2]);
        $c     = 0;
        foreach ($items as $item) {
            $item->set($c == 0 ? $data : $data2);
            $cache->save($item);
            $c++;
        }

        $itemsFromCache = $cache->getItemsByVars([$keyVar, $keyVar2]);

        $c = 0;
        foreach ($itemsFromCache as $item) {
            $this->assertEquals($c == 0 ? $data : $data2, $item->get());
            $this->assertEquals(
                $c == 0 ? 'prefix192f4c8b50dec4af9feae3e6db20080f' : 'prefix48fa73070a0ee520920a9430c84fec05',
                $item->getKey()
            );
            $c++;
        }
    }

    public function createCachePool()
    {
        $innerCachePool = new ArrayAdapter();
        $keyGenerator   = new Md5Generator('prefix');

        return new GeneratableKeyCachePool($innerCachePool, $keyGenerator);
    }
}
