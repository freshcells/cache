<?php

namespace Freshcells\Cache\Tests;

use Freshcells\Cache\CacheFactory;
use Freshcells\Cache\Tests\Resources\TestGeneratebleKeyCacheableService;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class GenerateableKeyCacheableTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testTrait()
    {
        $service = new TestGeneratebleKeyCacheableService();

        $innerCache = new ArrayAdapter();
        $cache      = CacheFactory::createGeneratableKeyCache($innerCache);

        $service->setCache($cache);

        $cacheKey     = ['this is' => 'the cache key'];
        $entity       = $service->load($cacheKey);
        $cachedItem   = $cache->getItemByVar($cacheKey);
        $cachedEntity = $cachedItem->get();

        $this->assertEquals($entity, $cachedEntity);

        $cachedEntity->foo = 'cached';
        $cachedItem->set($cachedEntity);
        $cache->save($cachedItem);

        $entity = $service->load($cacheKey);

        $this->assertEquals('cached', $entity->foo);
    }
}
