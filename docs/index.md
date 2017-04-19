# West\\Registry

A [PSR-11] implementation for PHP.


## Getting started

A registry contains only objects:
```php
namespace West\Registry;

$registry = new Registry(
    [
        'object' => new \stdClass()
    ]
);

$stdClass = $registry->get('object');
```

Passing a non-object to the registry triggers a `West\Registry\Exception\InvalidArgumentException`. To determine if a
key exists call `Registry::has`:
```php
// true
$registry->has('object');

// false
$registry->has('another-object');
```

Calling `Registry::get` for a key that fails `Registry::has` triggers a `West\Registry\Exception\NotFoundException`.

[PSR-11]: https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-11-registry.md: "PSR-11"