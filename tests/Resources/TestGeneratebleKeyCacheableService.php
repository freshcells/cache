<?php

namespace Freshcells\Cache\Tests\Resources;

use Freshcells\Cache\GeneratableKeyCachePoolAwareTrait;
use Freshcells\Cache\GenerateableKeyCacheableTrait;

class TestGeneratebleKeyCacheableService
{
    use GeneratableKeyCachePoolAwareTrait;
    use GenerateableKeyCacheableTrait;

    public function load($cacheKey)
    {
        return $this->cacheableByVar(
            $cacheKey,
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

