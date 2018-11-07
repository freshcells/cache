<?php

namespace Freshcells\Cache\Tests\CompressionCache;

use Cache\IntegrationTests\CachePoolTest;
use Freshcells\Cache\CompressionCache\Compression\GzCompression;
use Freshcells\Cache\CompressionCache\CompressionCachePool;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class CompressionCachePoolTest extends CachePoolTest
{
    protected $skippedTests = [
        'testSaveWithoutExpire'         => 'Does not work for ArrayAdapter',
        'testDeferredSaveWithoutCommit' => 'Does not work for ArrayAdapter',
    ];

    public function createCachePool()
    {
        $innerCachePool = new ArrayAdapter();
        $compression    = new GzCompression();

        return new CompressionCachePool($innerCachePool, $compression);
    }
}
