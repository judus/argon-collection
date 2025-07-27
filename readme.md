[![PHP](https://img.shields.io/badge/php-8.2+-blue)](https://www.php.net/)
[![Build](https://github.com/judus/argon-collection/actions/workflows/php.yml/badge.svg)](https://github.com/judus/argon-collection/actions)
[![codecov](https://codecov.io/gh/judus/argon-collection/branch/master/graph/badge.svg)](https://codecov.io/gh/judus/argon-collection)
[![Psalm Level](https://shepherd.dev/github/judus/argon-collection/coverage.svg)](https://shepherd.dev/github/judus/argon-collection)
[![Code Style](https://img.shields.io/badge/code%20style-PSR--12-brightgreen.svg)](https://www.php-fig.org/psr/psr-12/)
[![Latest Version](https://img.shields.io/packagist/v/maduser/argon-collection.svg)](https://packagist.org/packages/maduser/argon-collection)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT)

# Argon Collection

A set of generic, type-safe collection classes for PHP.

* List-style collections (`ListCollection`, `TypedListCollection`)
* Map-style collections (`MapCollection`, `TypedMapCollection`)
* Iterable, countable, and fluent via common collection operations (`map`, `filter`, `reduce`, etc.)

## Requirements

* PHP 8.2+
* Psalm (recommended for type safety)

## Installation

```bash
composer require maduser/argon-collection
```

## Usage

### ListCollection

```php
use Maduser\Argon\Collection\ListCollection;

$collection = new ListCollection(['a', 'b', 'c']);

$collection->push('d');

foreach ($collection as $item) {
    echo $item;
}
```

### TypedListCollection

```php
use Maduser\Argon\Collection\TypedListCollection;

final class UserDto
{
    public function __construct(public string $name) {}
}

$list = new TypedListCollection(UserDto::class, [
    new UserDto('alice'),
    new UserDto('bob'),
]);

$list->push(new UserDto('charlie'));
```

### MapCollection

```php
use Maduser\Argon\Collection\MapCollection;

$map = new MapCollection(['one' => 1, 'two' => 2]);

$map->put('three', 3);
$value = $map->get('two');
```

### TypedMapCollection

```php
use Maduser\Argon\Collection\TypedMapCollection;

final class ConfigValue
{
    public function __construct(public string $key, public string $value) {}
}

$map = new TypedMapCollection(ConfigValue::class, [
    'db' => new ConfigValue('db', 'mysql'),
]);

$map->put('cache', new ConfigValue('cache', 'redis'));
```

## Collection Operations

All collections support fluent operations:

```php
$filtered = $collection->filter(fn($item) => $item !== 'a');
$mapped   = $collection->map(fn($item) => strtoupper($item));
$first    = $collection->first();
$reduced  = $collection->reduce(fn($carry, $item) => $carry . $item, '');
```

## License

MIT
