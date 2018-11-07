<?php

namespace Freshcells\Cache\Tests;

use Freshcells\Cache\CacheFactory;
use Freshcells\Cache\CompressionCache\CompressionCachePool;
use Freshcells\Cache\GeneratableKeyCache\GeneratableKeyCachePool;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class CacheFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testCreateGeneratableKeyCache()
    {
        $innerCachePool = new ArrayAdapter();
        $cache          = CacheFactory::createGeneratableKeyCache($innerCachePool, 'prefix');

        $this->assertInstanceOf(GeneratableKeyCachePool::class, $cache);
    }

    public function testCreateCompressionCache()
    {
        $innerCachePool = new ArrayAdapter();
        $cache          = CacheFactory::createCompressionCache($innerCachePool);

        $this->assertInstanceOf(CompressionCachePool::class, $cache);
    }

    public function testCreateCompressionGeneratableKeyCache()
    {
        $innerCachePool = new ArrayAdapter();
        $cache = CacheFactory::createCompressionGeneratableKeyCache($innerCachePool, 'prefix');

        $this->assertInstanceOf(GeneratableKeyCachePool::class, $cache);
    }
}
