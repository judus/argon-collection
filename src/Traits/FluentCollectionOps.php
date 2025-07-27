<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection\Traits;

/**
 * @template TKey of array-key
 * @template TValue
 */
trait FluentCollectionOps
{
    /**
     * Transforms each item in the collection using the given callback.
     *
     * @api
     * @param callable(TValue, TKey): mixed $callback A function to apply to each item.
     * @return static A new collection with transformed items.
     */
    public function map(callable $callback): static
    {
        $items = array_map($callback, $this->items);
        return new static($items);
    }

    /**
     * Filters items in the collection using the given callback.
     *
     * @api
     * @param callable(TValue, TKey): bool $callback A function that determines if an item should be kept.
     * @return static A new collection with only the items that passed the filter.
     */
    public function filter(callable $callback): static
    {
        $items = array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH);
        return new static($items);
    }

    /**
     * Retrieves the first item in the collection.
     *
     * @api
     * @return mixed|null The first item, or null if the collection is empty.
     */
    public function first(): mixed
    {
        /** @var TValue|false $first */
        $first = reset($this->items);
        return $first === false ? null : $first;
    }

    /**
     * Reduces the collection to a single value using a callback.
     *
     * @api
     * @template TAccumulator
     * @param callable(TAccumulator, TValue): TAccumulator $callback
     * @param TAccumulator $initial
     * @return TAccumulator
     */
    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * Extracts a specific field's values from all items in the collection.
     *
     * @api
     * @param string $field The field name to extract.
     * @return list<mixed|null> A list of values for the specified field.
     */
    public function pluck(string $field): array
    {
        return array_values(array_map(
        /**
         * @param mixed $item
         * @return mixed|null
         */
            fn(mixed $item) => is_object($item)
                ? $item->$field ?? null
                : null,
            $this->items
        ));
    }
}
