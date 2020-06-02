<?php

namespace Theatre\Tests;

use Theatre\PerformancesSummaries;
use Theatre\PerformanceSummary;
use Theatre\Tests\Fixtures\PerformanceFixtures;
use TypeError;

class PerformancesSummariesTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testPerformancesSummariesCollectionCanBeCreatedOnlyUsingObjectsOfPerformanceSummaryType(): void
    {
        $validParams = $this->validPerformancesSummariesParams();

        $performances = new PerformancesSummaries(...$validParams);

        $this->assertSame($validParams, $performances->getArrayCopy());
        $this->assertSame(reset($validParams), $performances->current());
        $this->assertInstanceOf(PerformanceSummary::class, $performances->current());
    }

    public function testPerformancesSummariesCollectionCannotBeCreatedUsingObjectsOfTypeDifferentThanPerformanceSummary(): void
    {
        $invalidParams = $this->invalidPerformancesSummariesParams();

        $this->expectException(TypeError::class);

        new PerformanceSummary(...$invalidParams);
    }
}
