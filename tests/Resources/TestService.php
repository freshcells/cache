<?php

namespace Freshcells\Cache\Tests\Resources;

use Freshcells\Cache\CachePoolAwareTrait;

class TestService
{
    use CachePoolAwareTrait;

    public function setEntity($key, $entity)
    {
        $item = $this->cache->getItem($key);
        if (!$item->isHit()) {
            $item->set($entity);

            return $this->cache->save($item);
        }

        return false;
    }

    public function getEntity($key)
    {
        $item = $this->cache->getItem($key);
        if ($item->isHit()) {
            return $item->get();
        }

        return false;
    }
}
