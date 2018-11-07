<?php

namespace Freshcells\Cache\Tests\GeneratableKeyCache;

use Cache\IntegrationTests\CachePoolTest;
use Freshcells\Cache\GeneratableKeyCache\GeneratableKeyCachePool;
use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\Md5Generator;
use Symfony\Component\Cache\Adapter\ArrayAdapter;

class GeneratableKeyCachePoolTest extends CachePoolTest
{
    protected $skippedTests = [
        'testSaveWithoutExpire'         => 'Does not work for ArrayAdapter',
        'testDeferredSaveWithoutCommit' => 'Does not work for ArrayAdapter',
    ];

    public function createCachePool()
    {
        $innerCachePool = new ArrayAdapter();
        $keyGenerator   = new Md5Generator('prefix');

        return new GeneratableKeyCachePool($innerCachePool, $keyGenerator);
    }
}
