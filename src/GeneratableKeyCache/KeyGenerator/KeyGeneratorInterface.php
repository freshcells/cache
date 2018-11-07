<?php

namespace Freshcells\Cache\GeneratableKeyCache\KeyGenerator;

/**
 * Interface KeyGeneratorInterface
 * @package Freshcells\Cache\GeneratableKeyCache\KeyGenerator
 */
interface KeyGeneratorInterface
{

    /**
     * generates the key for a given var
     *
     * @param mixed $keyVar
     * @return string
     */
    public function generate($keyVar): string;
}
