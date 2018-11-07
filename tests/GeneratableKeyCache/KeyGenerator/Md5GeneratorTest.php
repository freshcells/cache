<?php

namespace Freshcells\Cache\Tests\GeneratableKeyCache\KeyGenerator;

use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\Md5Generator;

class Md5GeneratorTest extends \PHPUnit_Framework_TestCase
{

    public function testKeyGeneration()
    {
        $generator = new Md5Generator();
        $token = $generator->generate('token');
        $this->assertEquals('94a08da1fecbb6e8b46990538c7b50b2', $token);
    }
}

