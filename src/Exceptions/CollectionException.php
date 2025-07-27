<?php

declare(strict_types=1);

namespace Maduser\Argon\Collection\Exceptions;

use RuntimeException;

final class CollectionException extends RuntimeException implements ArgonCollectionException
{
    public static function listDoesNotSupportKeys(): self
    {
        return new self('ListCollection does not support keys.');
    }

    public static function mapDoesNotSupportPush(): self
    {
        return new self('MapCollection does not support push(). Use put($key, $value).');
    }

    public static function expectedInstanceOf(string $expected, mixed $actual): self
    {
        return new self("Expected instance of $expected, got " . get_debug_type($actual));
    }
}
