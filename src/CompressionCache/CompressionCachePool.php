<?php

namespace Freshcells\Cache\CompressionCache;

use Freshcells\Cache\CompressionCache\Compression\CompressionInterface;
use Freshcells\Cache\Exception\InvalidArgumentException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

class CompressionCachePool implements CacheItemPoolInterface
{
    /**
     * @var CacheItemPoolInterface
     */
    private $cache;

    /**
     * @var CompressionInterface
     */
    private $compression;

    /**
     * CompressionCachePool constructor.
     * @param CacheItemPoolInterface $cache
     * @param CompressionInterface $compression
     */
    public function __construct(CacheItemPoolInterface $cache, CompressionInterface $compression)
    {
        $this->cache       = $cache;
        $this->compression = $compression;
    }

    /**
     * {@inheritdoc}
     */
    public function getItem($key)
    {
        $items = $this->getItems([$key]);

        return reset($items);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems(array $keys = [])
    {
        $ret   = [];
        $items = $this->cache->getItems($keys);
        // we cant use array_map here because of usage of yield in symfony cache
        foreach ($items as $key => $inner) {
            $elem = $inner;
            if (!$inner instanceof CompressionCacheItem) {
                //here we have new Item -> set originalKey
                $elem = new CompressionCacheItem(
                    $inner,
                    $this->compression
                );
            }
            $ret[$key] = $elem;
        }

        return $ret;
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
        if (!$item instanceof CompressionCacheItem) {
            throw new InvalidArgumentException(
                'Cache items are not transferable between pools. Item MUST implement '.CompressionCacheItem::class.'.'
            );
        }

        return $this->cache->save($item->getCacheItem());
    }

    /**
     * {@inheritdoc}
     */
    public function saveDeferred(CacheItemInterface $item)
    {
        if (!$item instanceof CompressionCacheItem) {
            throw new InvalidArgumentException(
                'Cache items are not transferable between pools. Item MUST implement '.CompressionCacheItem::class.'.'
            );
        }

        return $this->cache->saveDeferred($item->getCacheItem());
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
}
