<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use Maduser\Argon\Collection\Traits\TypedEnforcer;

/**
 * @template TValue of object
 * @extends ListCollection<TValue>
 */
class TypedListCollection extends ListCollection
{
    use TypedEnforcer;

    /**
     * @param class-string<TValue> $type
     * @param iterable<TValue> $items
     *
     * @noinspection PhpMissingParentConstructorInspection
     */
    public function __construct(string $type, iterable $items = [])
    {
        $this->type = $type;

        foreach ($items as $item) {
            $this->push($item);
        }
    }

    /**
     * @param TValue $value
     */
    public function push(mixed $value): void
    {
        $this->assertType($value);
        parent::push($value);
    }
}

