<?php

namespace Freshcells\Cache\Tests;

use Freshcells\Cache\CacheFactory;
use Freshcells\Cache\Tests\Resources\TestEntity;
use Freshcells\Cache\Tests\Resources\TestGeneratableKeyService;
use Freshcells\Cache\Tests\Resources\TestService;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class GeneratableKeyCachePoolAwareTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testTrait()
    {
        $entity  = new TestEntity();
        $service = new TestGeneratableKeyService();

        $innerCache = new ArrayAdapter();
        $cache      = CacheFactory::createCompressionGeneratableKeyCache($innerCache);

        $service->setCache($cache);

        $keyVar      = new \stdClass();
        $keyVar->foo = ['biz' => 'baz'];
        $service->setEntity($keyVar, $entity);

        $cachedEntity = $service->getEntity($keyVar);

        $this->assertEquals($entity, $cachedEntity);
    }
}
