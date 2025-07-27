<?php

declare(strict_types=1);

namespace Tests\Unit\Traits;

use Maduser\Argon\Collection\BaseCollection;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\DummyThing;

class FluentCollectionOpsTest extends TestCase
{
    public function testMapTransformsItems(): void
    {
        $collection = $this->make(['a', 'b']);
        $upper = $collection->map(fn($item) => strtoupper($item));

        self::assertSame(['A', 'B'], $upper->all());
    }

    public function testFilterKeepsOnlyMatchingItems(): void
    {
        $collection = $this->make([1, 2, 3, 4, 5]);
        $even = $collection->filter(fn($v) => $v % 2 === 0);

        self::assertSame([1 => 2, 3 => 4], $even->all());
    }

    public function testReduceAccumulatesValue(): void
    {
        $collection = $this->make([1, 2, 3]);
        $sum = $collection->reduce(fn($carry, $v) => $carry + $v, 0);

        self::assertSame(6, $sum);
    }

    public function testFirstReturnsFirstItem(): void
    {
        $collection = $this->make(['first', 'second']);
        self::assertSame('first', $collection->first());
    }

    public function testFirstReturnsNullIfEmpty(): void
    {
        $collection = $this->make([]);
        self::assertNull($collection->first());
    }

    public function testPluckExtractsFieldFromObjects(): void
    {
        $collection = $this->make([
            new DummyThing('X'),
            new DummyThing('Y'),
            new DummyThing('Z'),
        ]);

        self::assertSame(['X', 'Y', 'Z'], $collection->pluck('name'));
    }

    public function testPluckReturnsNullIfFieldMissing(): void
    {
        $collection = $this->make([(object) ['foo' => 'bar'], (object) []]);
        self::assertSame(['bar', null], $collection->pluck('foo'));
    }

    /**
     * @param array<int|string, mixed> $items
     * @return BaseCollection
     */
    private function make(array $items): BaseCollection
    {
        return new class ($items) extends BaseCollection {
            public function __construct(array $items)
            {
                $this->items = $items;
            }
        };
    }
}
