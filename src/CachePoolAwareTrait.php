<?php

namespace Freshcells\Cache;

use Psr\Cache\CacheItemPoolInterface;

trait CachePoolAwareTrait
{
    protected $cache;

    /**
     * @param CacheItemPoolInterface $cache
     */
    public function setCache(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }
}
