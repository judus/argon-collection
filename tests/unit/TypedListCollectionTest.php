<?php

declare(strict_types=1);

namespace Tests\Unit;

use Maduser\Argon\Collection\Exceptions\CollectionException;
use Maduser\Argon\Collection\TypedListCollection;
use PHPUnit\Framework\TestCase;
use Tests\Mocks\DummyThing;
use Tests\Mocks\NotDummy;

class TypedListCollectionTest extends TestCase
{
    public function testAcceptsOnlyInstancesOfSpecifiedType(): void
    {
        $item1 = new DummyThing('A');
        $item2 = new DummyThing('B');

        $collection = new TypedListCollection(DummyThing::class, [$item1]);
        $collection->push($item2);

        self::assertSame([$item1, $item2], $collection->all());
    }

    public function testRejectsNonMatchingType(): void
    {
        $this->expectException(CollectionException::class);
        $this->expectExceptionMessage('Expected instance of Tests\\Mocks\\DummyThing, got Tests\\Mocks\\NotDummy');

        $collection = new TypedListCollection(DummyThing::class);
        $collection->push(new NotDummy());
    }

    public function testConstructorEnforcesType(): void
    {
        $this->expectException(CollectionException::class);

        new TypedListCollection(DummyThing::class, [
            new DummyThing(),
            new NotDummy()
        ]);
    }
}
