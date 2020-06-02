<?php

namespace Theatre\Tests;

use Theatre\PerformanceSummary;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class PerformanceSummaryTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testContainsCorrectObjectsAfterCreation(): void
    {
        $performance   = $this->performance();
        $amount        = $this->amount();
        $creditVolumes = $this->creditVolumes();

        $performanceSummary = new PerformanceSummary($performance, $amount, $creditVolumes);

        $this->assertSame($performance, $performanceSummary->performance());
        $this->assertSame($amount, $performanceSummary->amount());
        $this->assertSame($creditVolumes, $performanceSummary->creditVolumes());
    }
}
