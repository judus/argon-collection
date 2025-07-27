<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use BadMethodCallException;

/**
 * @template TValue
 * @extends BaseCollection<int, TValue>
 */
class ListCollection extends BaseCollection
{
    /**
     * @param iterable<TValue> $items
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->items[] = $item;
        }
    }

    /**
     * @param TValue $value
     */
    public function push(mixed $value): void
    {
        $this->items[] = $value;
    }

    /**
     * @throws BadMethodCallException
     */
    public function put(mixed $key, mixed $value): void
    {
        throw new BadMethodCallException('ListCollection does not support keys.');
    }

    /**
     * @param int $index
     * @return TValue|null
     */
    public function get(int $index): mixed
    {
        return $this->items[$index] ?? null;
    }
}
