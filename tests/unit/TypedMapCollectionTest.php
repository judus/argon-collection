<?php

declare(strict_types=1);

namespace Tests\Unit;

use Maduser\Argon\Collection\Exceptions\CollectionException;
use Maduser\Argon\Collection\TypedMapCollection;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\DummyThing;
use Tests\Mocks\NotDummy;

class TypedMapCollectionTest extends TestCase
{
    public function testAcceptsOnlyInstancesOfSpecifiedType(): void
    {
        $item1 = new DummyThing('X');
        $item2 = new DummyThing('Y');

        $collection = new TypedMapCollection(DummyThing::class);
        $collection->put('a', $item1);
        $collection->put('b', $item2);

        self::assertSame(['a' => $item1, 'b' => $item2], $collection->all());
    }

    public function testRejectsNonMatchingType(): void
    {
        $this->expectException(CollectionException::class);
        $this->expectExceptionMessage('Expected instance of Tests\\Mocks\\DummyThing, got Tests\\Mocks\\NotDummy');

        $collection = new TypedMapCollection(DummyThing::class);
        $collection->put('wrong', new NotDummy());
    }

    public function testConstructorEnforcesType(): void
    {
        $this->expectException(CollectionException::class);

        new TypedMapCollection(DummyThing::class, [
            'x' => new DummyThing(),
            'y' => new NotDummy()
        ]);
    }
}
