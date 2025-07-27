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
     * @param callable(TValue, TKey): mixed $callback
     * @return static
     */
    public function map(callable $callback): static
    {
        $items = array_map($callback, $this->items);
        return new static($items);
    }

    /**
     * @param callable(TValue, TKey): bool $callback
     * @return static
     */
    public function filter(callable $callback): static
    {
        $items = array_filter($this->items, $callback, ARRAY_FILTER_USE_BOTH);
        return new static($items);
    }

    public function first(): mixed
    {
        return reset($this->items) ?: null;
    }

    public function reduce(callable $callback, mixed $initial = null): mixed
    {
        return array_reduce($this->items, $callback, $initial);
    }

    /**
     * @return list<mixed>
     */
    public function pluck(string $field): array
    {
        return array_map(fn($item) => $item->$field ?? null, $this->items);
    }
}