<?php

namespace Freshcells\Cache\Tests\CompressionCache\Compression;

use Freshcells\Cache\CompressionCache\Compression\GzCompression;

class GzCompressionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider getCompressionData
     */
    public function testCompression($input, $compressed) //$input, , $output
    {
        $compressor = new GzCompression();
        $compressedData = $compressor->compress($input);
        // Direct binary data is not suitable for displaying so lets encode it
        $encodedCompressedData = base64_encode($compressedData);
        $decompressedData = $compressor->decompress($compressedData);

        $this->assertEquals($compressed, $encodedCompressedData);
        $this->assertEquals($input, $decompressedData);
    }

    public function getCompressionData()
    {
        $obj = new \stdClass();
        $obj->foo = 'baz';

        return [
            ['this is a test string', 'eJwrtjIytFIqycgsVgCiRIWS1OISheKSosy8dCVrAIqBCZY='],
            [['this' => 'is an array'], 'eJxLtDK0qi62MrFSKsnILFayLrYyNLRSyixWSMxTSCwqSqxUsq4FAMe4CyM='],
            [$obj, 'eJzzt7KwUiouSXHOSSwuVrIytKoutjK2UkrLz1eyBrOSEquUrGsB7RgL0Q==']
        ];
    }
}

