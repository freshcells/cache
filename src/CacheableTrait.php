<?php

namespace Freshcells\Cache;

trait CacheableTrait
{
    /**
     * wrapper method to fetch and save cache data
     *
     * @param string $cacheKey
     * @param callable $method
     * @param callable $validate
     * @return mixed
     */
    protected function cacheable(string $cacheKey, callable $method, callable $validate)
    {
        if ($this->cache === null) {
            return $method();
        }

        $cacheItem = $this->cache->getItem($cacheKey);
        if ($cacheItem->isHit()) {
            return $cacheItem->get();
        }

        $data = $method();
        if ($validate($data)) {
            $cacheItem->set($data);
            $this->cache->save($cacheItem);
        }

        return $data;
    }
}
