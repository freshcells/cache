<?php

namespace Freshcells\Cache\GeneratableKeyCache\KeyGenerator;

use Freshcells\Cache\GeneratableKeyCache\Exception\KeyGeneratorException;

/**
 * Class Md5Generator
 * @package Freshcells\Cache\GeneratableKeyCache\KeyGenerator
 */
class Md5Generator implements KeyGeneratorInterface
{

    protected $prefix = '';

    /**
     * Md5Generator constructor.
     * @param string $prefix
     */
    public function __construct(string $prefix = '')
    {
        $this->prefix = $prefix;
    }

    /**
     * generates the key as md5 hash for a given var
     *
     * @param mixed $keyVar
     * @return string
     */
    public function generate($keyVar): string
    {
        $var = $keyVar;
        if (!is_scalar($keyVar)) {
            $var = serialize($keyVar);
        }

        return $this->prefix.md5($var);
    }
}
