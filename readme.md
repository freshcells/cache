# Cache

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

PSR-6 Cache implementation with KeyGenerator and Compression.

### KeyGeneration
This is an extension to PSR-6.  
Cache data by a given var as key.  
This can be an object, an array or any var.  
Key-generation with SerializeKeyGenerator will serialize and md5 the given var, further you can add a custom prefix to it.  

You can also define your own KeyGenerator according your needs by implementing the interfaces.

It is designed to cache data by a variable resp. query-object and the key will be generated based on this var.
If you know the cache-key beforehand you can directly use the cache-pool instance instead.  

    $keyVar      = new \stdClass();
    $keyVar->foo = ['baz' => 'bif'];
    $item = $cache->getItemByVar($keyVar);
    $item->set($data);
    $cache->save($item);
    $itemFromCache = $cache->getItemByVar($keyVar);


### Compression
Data can be compressed and data will be serialized before its passed to the cache if possible.

    $compression    = new GzCompression();
    $cache = CompressionCachePool($innerCachePool, $compression);


### Traits
Cache aware Traits for normal PSR-6 `CacheItemPoolInterface` and extended `GeneratableKeyCache` are provided.

*CacheableTrait* provides a wrapper method to fetch and save cache data.

##### Todo
Symfony Bridge Cache Bundle
with CompilerPass for tag cacher.aware
tag:
  - name: 'cacher.aware', cache: cache.pool.service, enabled: %cache.enabled%

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/freshcells/cache.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/freshcells/cache/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/freshcells/cache.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/freshcells/cache.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/freshcells/cache.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/freshcells/soap-client-bundle
[link-travis]: https://travis-ci.org/freshcells/soap-client-bundle
[link-scrutinizer]: https://scrutinizer-ci.com/g/freshcells/soap-client-bundle/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/freshcells/soap-client-bundle
[link-downloads]: https://packagist.org/packages/freshcells/soap-client-bundle
[link-author]: https://github.com/freshcells
[link-contributors]: ../../contributors