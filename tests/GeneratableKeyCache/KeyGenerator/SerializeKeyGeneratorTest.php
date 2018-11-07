<?php

namespace Freshcells\Cache\Tests\GeneratableKeyCache\KeyGenerator;

use Freshcells\Cache\GeneratableKeyCache\KeyGenerator\SerializeKeyGenerator;

class SerializeKeyGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGenerate()
    {
        $generator = new SerializeKeyGenerator();

        $generated = $generator->generate('this is a string');
        $this->assertEquals('517592df8fec', $generated);

        $generated = $generator->generate(['one', ['two'], 'three']);
        $this->assertEquals('c1f854d385fc', $generated);

        $object       = new \stdClass();
        $object->that = 'this';
        $object->foo  = ['bar'];
        $generated    = $generator->generate($object);
        $this->assertEquals('cbf8cabbfe5b', $generated);
    }
}
