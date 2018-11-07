<?php

namespace Freshcells\Cache\CompressionCache\Compression;

/**
 * Interface CompressionInterface
 * @package Freshcells\Cache\CompressionCache\Compression
 */
interface CompressionInterface
{
    /**
     * compress given data
     * @param mixed $data
     * @return mixed compressed data
     */
    public function compress($data);

    /**
     * decompress given data
     * @param mixed$data
     * @return mixed decompressed data
     */
    public function decompress($data);
}
