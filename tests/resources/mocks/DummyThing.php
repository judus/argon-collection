<?php

declare(strict_types=1);

namespace Tests\Mocks;

final class DummyThing
{
    public function __construct(public string $name = 'Test')
    {
    }
}
