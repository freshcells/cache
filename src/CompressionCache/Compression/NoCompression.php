<?php

namespace Freshcells\Cache\CompressionCache\Compression;

/**
 * Class NoCompression
 * @package Freshcells\Cache\CompressionCache\Compression
 */
class NoCompression implements CompressionInterface
{
    /**
     * compress given data
     * @param mixed $data
     * @return mixed compressed data
     */
    public function compress($data)
    {
        return $data;
    }

    /**
     * decompress given data.
     *
     * @param mixed $data
     * @return mixed decompressed data
     */
    public function decompress($data)
    {
        return $data;
    }
}
