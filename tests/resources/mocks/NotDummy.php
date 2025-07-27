<?php

declare(strict_types=1);

namespace Tests\Mocks;

final class NotDummy
{
    public function __construct(public int $value = 42)
    {
    }
}
