<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use IteratorAggregate;
use Countable;
use Maduser\Argon\Collection\Traits\FluentCollectionOps;
use Traversable;
use ArrayIterator;

/**
 * @template TKey of array-key
 * @template TValue
 * @implements IteratorAggregate<TKey, TValue>
 */
abstract class BaseCollection implements IteratorAggregate, Countable
{
    use FluentCollectionOps;

    /** @var array<TKey, TValue> */
    protected array $items = [];

    /**
     * @return array<TKey, TValue>
     */
    public function all(): array
    {
        return $this->items;
    }

    public function count(): int
    {
        return count($this->items);
    }

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->items);
    }

    public function isEmpty(): bool
    {
        return empty($this->items);
    }
}
