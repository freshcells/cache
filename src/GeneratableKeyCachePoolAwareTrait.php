<?php

namespace Freshcells\Cache;

use Freshcells\Cache\GeneratableKeyCache\GeneratableKeyCache;

trait GeneratableKeyCachePoolAwareTrait
{
    protected $cache;

    /**
     * @param GeneratableKeyCache $cache
     */
    public function setCache(GeneratableKeyCache $cache)
    {
        $this->cache = $cache;
    }
}
