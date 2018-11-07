<?php

namespace Freshcells\Cache\Tests\CompressionCache\Compression;

use Freshcells\Cache\CompressionCache\Compression\NoCompression;

class NoCompressionTest extends \PHPUnit_Framework_TestCase
{
    const TOKEN = 'token';

    public function testCompress()
    {
        $subject = new NoCompression();
        $result = $subject->compress(self::TOKEN);

        $this->assertEquals(self::TOKEN, $result);
    }

    public function testDecompress()
    {
        $subject = new NoCompression();
        $result = $subject->decompress(self::TOKEN);

        $this->assertEquals(self::TOKEN, $result);
    }

    public function testNoExceptionOnValidCompressionArgument()
    {
        $subject = new NoCompression();
        $this->assertNull($subject->compress(null));
        $this->assertNull($subject->decompress(null));
    }
}

