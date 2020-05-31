<?php

namespace Theatre\Tests;

use Theatre\Performance;
use Theatre\Performances;
use Theatre\Tests\Fixtures\PerformanceFixtures;
use TypeError;

class PerformancesTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testPerformancesCollectionCanBeCreatedOnlyUsingObjectsOfPerformanceType(): void
    {
        $validParams = $this->validPerformanceParams();

        $performances = new Performances(...$validParams);

        $this->assertSame($validParams, $performances->getArrayCopy());
        $this->assertSame(reset($validParams), $performances->current());
        $this->assertInstanceOf(Performance::class, $performances->current());
    }

    public function testPerformancesCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPerformance(): void
    {
        $invalidParams = $this->invalidPerformancesParams();

        $this->expectException(TypeError::class);

        new Performances(...$invalidParams);
    }
}
