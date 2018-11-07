<?php

namespace Freshcells\Cache\GeneratableKeyCache;

use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\KeyGeneratorInterface;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class GeneratableKeyCachePool implements GeneratableKeyCache
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;
    /**
     * @var KeyGeneratorInterface
     */
    private $keyGenerator;

    /**
     * Cache constructor.
     * @param CacheItemPoolInterface $cache
     * @param KeyGeneratorInterface $keyGenerator
     */
    public function __construct(
        CacheItemPoolInterface $cache,
        KeyGeneratorInterface $keyGenerator
    ) {
        $this->cache        = $cache;
        $this->keyGenerator = $keyGenerator;
    }

    public function getItemByVar($keyVar)
    {
        return $this->getItem($this->buildKey($keyVar));
    }

    public function getItemsByVars(array $keyVars = [])
    {
        $keyVars = array_map(function ($keyVar) {
            return $this->buildKey($keyVar);
        }, $keyVars);

        return $this->getItems($keyVars);
    }

    public function hasItemByVar($keyVar)
    {
        return $this->hasItem($this->buildKey($keyVar));
    }

    public function deleteItemByVar($keyVar)
    {
        return $this->deleteItem($this->buildKey($keyVar));
    }

    public function deleteItemsByVars(array $keyVars = [])
    {
        $keyVars = array_map(function ($keyVar) {
            return $this->buildKey($keyVar);
        }, $keyVars);

        return $this->deleteItems($keyVars);
    }

    /**
     * {@inheritdoc}
     */
    public function getItem($key)
    {
        return $this->cache->getItem($key);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(array $keys = [])
    {
        return $this->cache->getItems($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function hasItem($key)
    {
        return $this->cache->hasItem($key);
    }

    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        return $this->cache->clear();
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItem($key)
    {
        return $this->cache->deleteItem($key);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteItems(array $keys)
    {
        return $this->cache->deleteItems($keys);
    }

    /**
     * {@inheritdoc}
     */
    public function save(CacheItemInterface $item)
    {
        return $this->cache->save($item);
    }

    /**
     * {@inheritdoc}
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        return $this->cache->saveDeferred($item);
    }

    /**
     * {@inheritdoc}
     */
    public function commit()
    {
        return $this->cache->commit();
    }

    /**
     * Make sure to commit before we destruct.
     */
    public function __destruct()
    {
        $this->commit();
    }

    /**
     * @param $keyVar
     * @return string
     */
    public function buildKey($keyVar): string
    {
        return $this->keyGenerator->generate($keyVar);
    }
}
