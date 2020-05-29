<?php

namespace Theatre\Tests;

use Theatre\Plays;
use PHPUnit\Framework\TestCase;
use TypeError;

class PlaysTest extends TestCase
{
    use Fixtures;

    public function testPlaysCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPlay(): void
    {
        $invalidParams = $this->invalidPlayParams();

        $this->expectException(TypeError::class);

        new Plays(...$invalidParams);
    }

    public function testPlaysCollectionCanBeCreatedOnlyUsingObjectsOfPlayType(): void
    {
        $validParams = $this->validPlayParams();

        $performances = new Plays(...$validParams);

        $this->assertSame($validParams, $performances->getArrayCopy());
    }
}
