<?php

namespace Freshcells\Cache\Tests\GeneratableKeyCache\KeyGenerator;

use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\Sha1ShortGenerator;

class Sha1ShortGeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function testKeyGeneration()
    {
        $generator = new Sha1ShortGenerator();
        $token = $generator->generate('token');
        $this->assertEquals('ee97780', $token);
    }

    /**
     * @expectedExceptionMessage Cannot use anything else than a string for key generation.  You passed integer
     * @expectedException Freshcells\Cache\GeneratableKeyCache\Exception\KeyGeneratorException
     */
    public function testExceptionOnNonStringArgument()
    {
        $generator = new Sha1ShortGenerator();
        $generator->generate(4711);
    }
}

