<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection\Traits;

trait TypedEnforcer
{
    /** @var class-string */
    protected string $type;

    protected function assertType(mixed $item): void
    {
        if (!($item instanceof $this->type)) {
            throw new \InvalidArgumentException(
                "Expected instance of {$this->type}, got " . get_debug_type($item)
            );
        }
    }
}