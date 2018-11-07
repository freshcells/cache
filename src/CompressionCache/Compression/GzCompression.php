<?php

namespace Freshcells\Cache\CompressionCache\Compression;

use Freshcells\Cache\CompressionCache\Exception\CompressionException;

/**
 * Class GzCompression
 * @package Freshcells\Cache\CompressionCache\Compression
 */
class GzCompression implements CompressionInterface
{
    /**
     * @throws CompressionException
     * @inheritdoc
     */
    public function compress($data)
    {
        $data       = serialize($data);
        $compressed = @gzcompress($data);
        if ($compressed === false || $compressed == null) {
            throw new CompressionException(
                'Compression failed. Result of the compression must not be null or false.'
            );
        }

        return $compressed;
    }

    /**
     * @throws CompressionException
     * @inheritdoc
     */
    public function decompress($data)
    {
        $decompressed = @gzuncompress($data);
        if ($decompressed === false || $decompressed == null) {
            throw new CompressionException(
                'Decompression failed. Result of the decompression must not be null or false'
            );
        }

        return unserialize($decompressed);
    }
}
