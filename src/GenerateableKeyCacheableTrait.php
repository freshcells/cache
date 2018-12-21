<?php

namespace Freshcells\Cache;

trait GenerateableKeyCacheableTrait
{
    /**
     * wrapper method to fetch and save cache data
     *
     * @param mixed $cacheKey
     * @param callable $method
     * @param callable $validate
     * @return mixed
     */
    protected function cacheableByVar($cacheKey, callable $method, callable $validate)
    {
        if ($this->cache === null) {
            return $method();
        }

        $cacheItem = $this->cache->getItemByVar($cacheKey);
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
