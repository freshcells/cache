# Cache

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

##### Todo
Symfony Bridge Cache Bundle
with CompilerPass for tag cacher.aware
tag:
  - name: 'cacher.aware', cache: cache.pool.service, enabled: %cache.enabled%
