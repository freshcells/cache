<?php

namespace Freshcells\Cache\GeneratableKeyCache\KeyGenerator;

use Freshcells\Cache\GeneratableKeyCache\Exception\KeyGeneratorException;

/**
 * Class Sha1ShortGenerator
 * @package Freshcells\Cache\GeneratableKeyCache\KeyGenerator
 */
class Sha1ShortGenerator implements KeyGeneratorInterface
{
    protected $prefix = '';

    /**
     * Sha1ShortGenerator constructor.
     * @param string $prefix
     */
    public function __construct(string $prefix = '')
    {
        $this->prefix = $prefix;
    }

    /**
     * generates the key as md5 hash for a given var
     *
     * @param $keyVar
     * @return string
     * @throws KeyGeneratorException
     */
    public function generate($keyVar): string
    {
        $var = $keyVar;
        if (!is_string($keyVar)) {
            throw new KeyGeneratorException(
                'Cannot use anything else than a string for key generation. '
                .' You passed '.gettype($keyVar)
            );
        }

        // SHA1 collision probability is quite low (see https://en.wikipedia.org/wiki/Birthday_problem).
        // 7 chars give you 28bit with 240 million possibilities (see
        // http://blog.cuviper.com/2013/11/10/how-short-can-git-abbreviate/).
        // Concerning the space we save for the keys this is quite a good trade. If you ever come back to this
        // place and you need a lower chance of collision, raise this number to 12. This would even be enough for the
        // full linux kernel.
        return $this->prefix.substr(sha1($var), 0, 7);
    }
}
