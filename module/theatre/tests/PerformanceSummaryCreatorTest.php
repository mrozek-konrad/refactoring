<?php

namespace Theatre\Tests;

use Theatre\AmountCalculator;
use Theatre\CreditVolumesCalculator;
use Theatre\PerformanceSummary;
use Theatre\PerformanceSummaryCreator;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class PerformanceSummaryCreatorTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testCreatorUsesAmountAndCreditVolumesCalculatorsToCreatePerformanceSummary(): void
    {
        $performance              = $this->performance();
        $calculatedAmount         = $this->amount();
        $calculatedCreditsVolumes = $this->creditVolumes();

        $amountCalculator = $this->createMock(AmountCalculator::class);
        $amountCalculator->expects($this->once())->method('calculate')->with($performance)->willReturn($calculatedAmount);

        $creditVolumesCalculator = $this->createMock(CreditVolumesCalculator::class);
        $creditVolumesCalculator->expects($this->once())->method('calculate')->with($performance)->willReturn($calculatedCreditsVolumes);

        $performanceSummaryCalculator = new PerformanceSummaryCreator($amountCalculator, $creditVolumesCalculator);

        $performanceSummary = $performanceSummaryCalculator->create($performance);

        $this->assertInstanceOf(PerformanceSummary::class, $performanceSummary);
        $this->assertSame($performance, $performanceSummary->performance());
        $this->assertSame($calculatedAmount, $performanceSummary->amount());
        $this->assertSame($calculatedCreditsVolumes, $performanceSummary->creditVolumes());
    }
}
