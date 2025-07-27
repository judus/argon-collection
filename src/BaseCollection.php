<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use IteratorAggregate;
use Countable;
use Maduser\Argon\Collection\Traits\FluentCollectionOps;
use Traversable;
use ArrayIterator;

/**
 * Abstract base class for collections providing iterable and countable behavior.
 *
 * @template TKey of array-key
 * @template TValue
 * @implements IteratorAggregate<TKey, TValue>
 */
abstract class BaseCollection implements IteratorAggregate, Countable
{
    /** @use FluentCollectionOps<TKey, TValue> */
    use FluentCollectionOps;

    /** @var array<TKey, TValue> */
    protected array $items = [];

    /**
     * Returns all items in the collection as an array.
     *
     * @api
     * @return array<TKey, TValue> The underlying array of items.
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * Returns the number of items in the collection.
     *
     * @api
     * @return int The count of items.
     */
    public function count(): int
    {
        return count($this->items);
    }

    /**
     * Returns an iterator for traversing the collection.
     *
     * @api
     * @return Traversable<TKey, TValue> An iterator over the items.
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Checks whether the collection is empty.
     *
     * @api
     * @return bool True if the collection is empty, false otherwise.
     */
    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
