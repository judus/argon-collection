<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection;

use Maduser\Argon\Collection\Traits\TypedEnforcer;

/**
 * @api
 * @template T of object
 * @extends ListCollection<T>
 */
class TypedListCollection extends ListCollection
{
    use TypedEnforcer;

    /**
     * @param class-string<T> $type
     * @param iterable<T> $items
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
     * @param T $value
     */
    public function push(mixed $value): void
    {
        $this->assertType($value);
        parent::push($value);
    }
}
