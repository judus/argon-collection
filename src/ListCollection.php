<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use Maduser\Argon\Collection\Exceptions\CollectionException;

/**
 * A sequential list-style collection with integer keys.
 *
 * @template TValue
 * @extends BaseCollection<int, TValue>
 */
class ListCollection extends BaseCollection
{
    /**
     * Initializes the list collection with items.
     *
     * @api
     * @param iterable<TValue> $items Items to populate the list.
     */
    public function __construct(iterable $items = [])
    {
        foreach ($items as $item) {
            $this->items[] = $item;
        }
    }

    /**
     * @api
     * @template T as TValue
     * @psalm-param T $value
     * @param mixed $value
     */
    public function push(mixed $value): void
    {
        /** @psalm-suppress MixedPropertyTypeCoercion */
        $this->items[] = $value;
    }

    /**
     * Not supported on list collections.
     *
     * @api
     * @throws CollectionException Always throws an exception.
     * @psalm-suppress PossiblyUnusedParam
     * @noinspection PhpUnusedParameterInspection*
     */
    public function put(mixed $key, mixed $value): void
    {
        throw CollectionException::listDoesNotSupportKeys();
    }

    /**
     * Retrieves the value at the given index.
     *
     * @api
     * @param int $index The index to retrieve.
     * @return TValue|null The value at the given index, or null if not set.
     */
    public function get(int $index): mixed
    {
        return $this->items[$index] ?? null;
    }
}
