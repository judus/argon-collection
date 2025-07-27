<?php

declare(strict_types=1);

namespace Tests\Unit;

use Maduser\Argon\Collection\Exceptions\CollectionException;
use Maduser\Argon\Collection\MapCollection;
use PHPUnit\Framework\TestCase;

class MapCollectionTest extends TestCase
{
    public function testPutAddsItemWithKey(): void
    {
        $collection = new MapCollection();
        $collection->put('x', 42);

        self::assertSame(['x' => 42], $collection->all());
    }

    public function testGetReturnsCorrectValue(): void
    {
        $collection = new MapCollection(['a' => 'apple', 'b' => 'banana']);

        self::assertSame('apple', $collection->get('a'));
        self::assertSame('banana', $collection->get('b'));
    }

    public function testGetReturnsNullForMissingKey(): void
    {
        $collection = new MapCollection(['one' => 1]);

        self::assertNull($collection->get('missing'));
    }

    public function testPushThrowsCollectionException(): void
    {
        $this->expectException(CollectionException::class);
        $this->expectExceptionMessage('MapCollection does not support push(). Use put($key, $value).');

        $collection = new MapCollection();
        $collection->push('invalid');
    }
}
