<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use Maduser\Argon\Collection\Traits\TypedEnforcer;

/**
 * @template TKey of array-key
 * @template TValue of object
 * @extends MapCollection<TKey, TValue>
 */
class TypedMapCollection extends MapCollection
{
    use TypedEnforcer;

    /**
     * @param class-string<TValue> $type
     * @param iterable<TKey, TValue> $items
     *
     * @noinspection PhpMissingParentConstructorInspection
     */
    public function __construct(string $type, iterable $items = [])
    {
        $this->type = $type;

        foreach ($items as $key => $item) {
            $this->put($key, $item);
        }
    }

    /**
     * @param TKey $key
     * @param TValue $value
     */
    public function put(mixed $key, mixed $value): void
    {
        $this->assertType($value);
        parent::put($key, $value);
    }
}
