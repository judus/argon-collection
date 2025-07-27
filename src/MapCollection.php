<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use BadMethodCallException;
use Maduser\Argon\Collection\BaseCollection;
use Maduser\Argon\Collection\Exceptions\CollectionException;

/**
 * A key-value collection that preserves map semantics.
 *
 * @template TKey of array-key
 * @template TValue
 * @extends BaseCollection<TKey, TValue>
 */
class MapCollection extends BaseCollection
{
    /**
     * Initializes the map collection with key-value pairs.
     *
     * @api
     * @param iterable<TKey, TValue> $items Items to populate the map.
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $key => $item) {
            $this->items[$key] = $item;
        }
    }

    /**
     * Inserts or updates an item in the map by key.
     *
     * @api
     * @param TKey $key The key to assign the value to.
     * @param TValue $value The value to store.
     */
    public function put(mixed $key, mixed $value): void
    {
        $this->items[$key] = $value;
    }

    /**
     * Not supported on map collections.
     *
     * @api
     * @psalm-suppress PossiblyUnusedParam
     * @throws BadMethodCallException Always throws an exception.
     */
    public function push(mixed $value): void
    {
        throw CollectionException::mapDoesNotSupportPush();
    }

    /**
     * Retrieves the value associated with the given key.
     *
     * @api
     * @param TKey $key The key to look up.
     * @return TValue|null The value, or null if the key does not exist.
     */
    public function get(mixed $key): mixed
    {
        return $this->items[$key] ?? null;
    }
}
