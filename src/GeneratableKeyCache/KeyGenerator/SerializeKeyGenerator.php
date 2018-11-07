<?php

namespace Freshcells\Cache\GeneratableKeyCache\KeyGenerator;

/**
 * Class SerializeKeyGenerator
 * @package Freshcells\Cache\KeyGenerator
 */
class SerializeKeyGenerator implements KeyGeneratorInterface
{
    protected $prefix = '';

    /**
     * SerializeKeyGenerator constructor.
     * @param string $prefix
     */
    public function __construct(string $prefix = '')
    {
        $this->prefix = $prefix;
    }

    /**
     * @inheritdoc
     */
    public function generate($keyVar): string
    {
        $var = $keyVar;
        if (!is_scalar($keyVar)) {
            $var = serialize($keyVar);
        }

        return $this->prefix.substr(sha1($var), 0, 12);
    }
}
