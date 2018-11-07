<?php

namespace Freshcells\Cache\Tests\CompressionCache;

use Cache\Adapter\Common\CacheItem;
use Freshcells\Cache\CompressionCache\Compression\GzCompression;
use Freshcells\Cache\CompressionCache\CompressionCacheItem;

class CompressionCacheItemTest extends \PHPUnit_Framework_TestCase
{
    public function testCacheItem()
    {
        $innerCacheItem = new CacheItem('key');
        $compression = new GzCompression();
        $cacheItem     = new CompressionCacheItem($innerCacheItem, $compression);
        $data = ['this is' => 'an array'];
        $cacheItem->set($data);
        $this->assertEquals($data, $cacheItem->get());
    }
}
