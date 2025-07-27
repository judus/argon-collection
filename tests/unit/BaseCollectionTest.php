<?php

declare(strict_types=1);

namespace Tests\Unit;

use Maduser\Argon\Collection\BaseCollection;
use PHPUnit\Framework\TestCase;
use Traversable;

class BaseCollectionTest extends TestCase
{
    private BaseCollection $collection;

    protected function setUp(): void
    {
        $this->collection = new class ([1, 2, 3]) extends BaseCollection {
            public function __construct(array $items)
            {
                $this->items = $items;
            }
        };
    }

    public function testAllReturnsItems(): void
    {
        $this->assertSame([1, 2, 3], $this->collection->all());
    }

    public function testCountReturnsCorrectNumber(): void
    {
        $this->assertSame(3, $this->collection->count());
    }

    public function testIsEmptyReturnsFalseWhenNotEmpty(): void
    {
        $this->assertFalse($this->collection->isEmpty());
    }

    public function testIsEmptyReturnsTrueWhenEmpty(): void
    {
        $collection = new class extends BaseCollection {
            public function __construct()
            {
            }
        };

        $this->assertTrue($collection->isEmpty());
    }

    public function testGetIteratorReturnsTraversable(): void
    {
        $this->assertInstanceOf(Traversable::class, $this->collection->getIterator());
        $this->assertSame([1, 2, 3], iterator_to_array($this->collection->getIterator()));
    }
}
