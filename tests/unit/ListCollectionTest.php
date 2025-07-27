<?php

declare(strict_types=1);

namespace Tests\Unit;

use Maduser\Argon\Collection\Exceptions\CollectionException;
use Maduser\Argon\Collection\ListCollection;
use PHPUnit\Framework\TestCase;

class ListCollectionTest extends TestCase
{
    public function testPushAppendsItem(): void
    {
        $collection = new ListCollection();
        $collection->push('A');
        $collection->push('B');

        self::assertSame(['A', 'B'], $collection->all());
    }

    public function testGetReturnsCorrectItem(): void
    {
        $collection = new ListCollection(['apple', 'banana']);

        self::assertSame('apple', $collection->get(0));
        self::assertSame('banana', $collection->get(1));
    }

    public function testGetReturnsNullIfIndexNotExists(): void
    {
        $collection = new ListCollection(['cat']);

        self::assertNull($collection->get(10));
    }

    public function testPutThrowsCollectionException(): void
    {
        $this->expectException(CollectionException::class);
        $this->expectExceptionMessage('ListCollection does not support keys.');

        $collection = new ListCollection();
        $collection->put('key', 'value');
    }
}
