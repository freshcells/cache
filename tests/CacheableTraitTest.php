<?php

namespace Freshcells\Cache\Tests;

use Freshcells\Cache\CacheFactory;
use Freshcells\Cache\Tests\Resources\TestCacheableService;
use Freshcells\Cache\Tests\Resources\TestEntity;
use Freshcells\Cache\Tests\Resources\TestService;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class CacheableTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testTrait()
    {
        $service = new TestCacheableService();

        $innerCache = new ArrayAdapter();
        $cache      = CacheFactory::createCompressionCache($innerCache);

        $service->setCache($cache);

        $entity = $service->load();

        $cachedItem   = $cache->getItem(TestCacheableService::CACHE_KEY);
        $cachedEntity = $cachedItem->get();

        $this->assertEquals($entity, $cachedEntity);

        $cachedEntity->foo = 'cached';
        $cachedItem->set($cachedEntity);
        $cache->save($cachedItem);

        $entity = $service->load();

        $this->assertEquals('cached', $entity->foo);
    }
}
