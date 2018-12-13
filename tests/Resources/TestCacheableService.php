<?php

namespace Freshcells\Cache\Tests\Resources;

use Freshcells\Cache\CacheableTrait;
use Freshcells\Cache\CachePoolAwareTrait;

class TestCacheableService
{
    const CACHE_KEY = 'cacheable-service';

    use CachePoolAwareTrait;
    use CacheableTrait;

    public function load()
    {
        return $this->cacheable(
            self::CACHE_KEY,
            function () {
                $entity = new TestEntity();

                return $entity;
            },
            function ($data) {
                return $data instanceof TestEntity;
            }
        );
    }
}
