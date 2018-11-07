<?php

namespace Freshcells\Cache\CompressionCache;

use Freshcells\Cache\CompressionCache\Compression\CompressionInterface;
use Psr\Cache\CacheItemInterface;

class CompressionCacheItem implements CacheItemInterface
{
    /**
     * @var CacheItemInterface
     */
    private $cacheItem;
    /**
     * @var CompressionInterface
     */
    private $compression;

    /**
     * CacheItem constructor.
     * @param CacheItemInterface $cacheItem
     * @param CompressionInterface $compression
     */
    public function __construct(
        CacheItemInterface $cacheItem,
        CompressionInterface $compression
    ) {
        $this->cacheItem   = $cacheItem;
        $this->compression = $compression;
    }

    /**
     * {@inheritdoc}
     */
    public function getKey()
    {
        return $this->cacheItem->getKey();
    }

    /**
     * @return CacheItemInterface
     */
    public function getCacheItem()
    {
        return $this->cacheItem;
    }

    /**
     * {@inheritdoc}
     */
    public function set($value)
    {
        $this->cacheItem->set($this->compression->compress($value));

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        if (!$this->isHit()) {
            return;
        }
        $item = $this->cacheItem->get();

        return $this->compression->decompress($item);
    }

    /**
     * {@inheritdoc}
     */
    public function isHit()
    {
        return $this->cacheItem->isHit();
    }

    /**
     * {@inheritdoc}
     */
    public function expiresAt($expiration)
    {
        $this->cacheItem->expiresAt($expiration);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function expiresAfter($time)
    {
        $this->cacheItem->expiresAfter($time);

        return $this;
    }
}
