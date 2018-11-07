<?php

namespace Freshcells\Cache\Tests;

use Freshcells\Cache\CacheFactory;
use Freshcells\Cache\Tests\Resources\TestEntity;
use Freshcells\Cache\Tests\Resources\TestService;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class CachePoolAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testTrait()
    {
        $entity  = new TestEntity();
        $service = new TestService();

        $innerCache = new ArrayAdapter();
        $cache      = CacheFactory::createCompressionCache($innerCache);

        $service->setCache($cache);

        $service->setEntity('key', $entity);

        $cachedEntity = $service->getEntity('key');

        $this->assertEquals($entity, $cachedEntity);
    }
}
