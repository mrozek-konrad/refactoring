<?php

namespace Theatre\Tests;

use PHPUnit\Framework\TestCase;
use Theatre\Performances;
use TypeError;

class PerformancesTest extends TestCase
{
    use Fixtures;

    public function testPerformancesCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPerformance(): void
    {
        $invalidParams = $this->invalidPerformanceParams();

        $this->expectException(TypeError::class);

        new Performances(...$invalidParams);
    }

    public function testPerformancesCollectionCanBeCreatedOnlyUsingObjectsOfPerformanceType(): void
    {
        $validParams = $this->validPerformanceParams();

        $performances = new Performances(...$validParams);

        $this->assertSame($validParams, $performances->getArrayCopy());
    }
}
