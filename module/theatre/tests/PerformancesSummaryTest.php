<?php

namespace Theatre\Tests;

use Theatre\PerformancesSummary;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class PerformancesSummaryTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testCreatedObjectHasValidState(): void
    {
        $performancesSummaries = $this->performancesSummaries();
        $totalAmount           = $this->amount();
        $totalCreditVolumes    = $this->creditVolumes();

        $performancesSummary = new PerformancesSummary($performancesSummaries, $totalAmount, $totalCreditVolumes);

        $this->assertSame($performancesSummaries, $performancesSummary->performancesSummaries());
        $this->assertSame($totalAmount, $performancesSummary->totalAmount());
        $this->assertSame($totalCreditVolumes, $performancesSummary->totalCreditVolumes());
    }
}
