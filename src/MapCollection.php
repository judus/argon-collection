<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use BadMethodCallException;
use Maduser\Argon\Collection\BaseCollection;

/**
 * @template TKey of array-key
 * @template TValue
 * @extends BaseCollection<TKey, TValue>
 */
class MapCollection extends BaseCollection
{
    /**
     * @param iterable<TKey, TValue> $items
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $key => $item) {
            $this->items[$key] = $item;
        }
    }

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function put(mixed $key, mixed $value): void
    {
        $this->items[$key] = $value;
    }

    /**
     * @throws BadMethodCallException
     */
    public function push(mixed $value): void
    {
        throw new BadMethodCallException('MapCollection does not support push(). Use put($key, $value).');
    }

    /**
     * @param TKey $key
     * @return TValue|null
     */
    public function get(mixed $key): mixed
    {
        return $this->items[$key] ?? null;
    }
}
