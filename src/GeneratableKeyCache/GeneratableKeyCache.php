<?php

namespace Freshcells\Cache\GeneratableKeyCache;

use Psr\Cache\CacheItemPoolInterface;

interface GeneratableKeyCache extends CacheItemPoolInterface
{
    /**
     * @param $keyVar
     * @return string
     */
    public function buildKey($keyVar): string;

    /**
     * @param mixed $keyVar
     * @return mixed
     */
    public function getItemByVar($keyVar);

    /**
     * @param array $keyVars
     * @return mixed
     */
    public function getItemsByVars(array $keyVars = []);

    /**
     * @param mixed $keyVar
     * @return mixed
     */
    public function hasItemByVar($keyVar);

    /**
     * @param mixed $keyVar
     * @return mixed
     */
    public function deleteItemByVar($keyVar);

    /**
     * @param array $keyVars
     * @return mixed
     */
    public function deleteItemsByVars(array $keyVars = []);
}
