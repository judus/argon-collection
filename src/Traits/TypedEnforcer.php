<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection\Traits;

use Maduser\Argon\Collection\Exceptions\CollectionException;

trait TypedEnforcer
{
    /** @var class-string */
    protected string $type;

    protected function assertType(mixed $item): void
    {
        if (!($item instanceof $this->type)) {
            throw CollectionException::expectedInstanceOf($this->type, $item);
        }
    }
}
