<?php

namespace Freshcells\Cache;

use Freshcells\Cache\CompressionCache\Compression\GzCompression;
use Freshcells\Cache\CompressionCache\CompressionCachePool;
use Freshcells\Cache\GeneratableKeyCache\GeneratableKeyCachePool;
use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\Md5Generator;
use Psr\Cache\CacheItemPoolInterface;

/**
 * Class CacheFactory
 * @package Freshcells\Cache
 */
class CacheFactory
{
    /**
     * @param CacheItemPoolInterface $cache
     * @param string $keyPrefix
     * @return GeneratableKeyCachePool
     */
    public static function createGeneratableKeyCache(
        CacheItemPoolInterface $cache,
        string $keyPrefix = ''
    ): GeneratableKeyCachePool {
        $keyGenerator = new Md5Generator($keyPrefix);

        return new GeneratableKeyCachePool($cache, $keyGenerator);
    }

    /**
     * @param CacheItemPoolInterface $cache
     * @return CompressionCachePool
     */
    public static function createCompressionCache(CacheItemPoolInterface $cache): CompressionCachePool
    {
        $compression = new GzCompression();

        return new CompressionCachePool($cache, $compression);
    }

    /**
     * @param CacheItemPoolInterface $cache
     * @param string $keyPrefix
     * @return GeneratableKeyCachePool
     */
    public static function createCompressionGeneratableKeyCache(
        CacheItemPoolInterface $cache,
        string $keyPrefix = ''
    ): GeneratableKeyCachePool {
        $compressionCache = self::createCompressionCache($cache);

        return self::createGeneratableKeyCache($compressionCache, $keyPrefix);
    }
}
