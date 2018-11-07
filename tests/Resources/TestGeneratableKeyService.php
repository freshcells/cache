<?php

namespace Freshcells\Cache\Tests\Resources;

use Freshcells\Cache\GeneratableKeyCachePoolAwareTrait;

class TestGeneratableKeyService
{
    use GeneratableKeyCachePoolAwareTrait;

    public function setEntity($key, $entity)
    {
        $item = $this->cache->getItemByVar($key);
        if (!$item->isHit()) {
            $item->set($entity);

            return $this->cache->save($item);
        }

        return false;
    }

    public function getEntity($key)
    {
        $item = $this->cache->getItemByVar($key);
        if ($item->isHit()) {
            return $item->get();
        }

        return false;
    }
}
