<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\AmountCalculator;
use Theatre\CreditVolumesCalculator;
use Theatre\PerformancesSummaries;
use Theatre\PerformancesSummary;
use Theatre\PerformancesSummaryCreator;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class PerformancesSummaryCreatorTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testCalculatesAmountForEachPerformance(): void
    {
        $amountCalculator        = $this->createMock(AmountCalculator::class);
        $creditVolumesCalculator = $this->createMock(CreditVolumesCalculator::class);

        $performances     = $this->performances();
        $calculatedAmount = $this->amount();

        $amountCalculator->expects($this->exactly(count($performances)))->method('calculate')->willReturn($calculatedAmount);

        $performanceSummaryCalculator = new PerformancesSummaryCreator($amountCalculator, $creditVolumesCalculator);

        $performanceSummaryCalculator->createSummary($performances);
    }

    public function testCalculatesCreditVolumesForEachPerformance(): void
    {
        $amountCalculator        = $this->createMock(AmountCalculator::class);
        $creditVolumesCalculator = $this->createMock(CreditVolumesCalculator::class);

        $performances            = $this->performances();
        $calculatedCreditVolumes = $this->creditVolumes();

        $creditVolumesCalculator->expects($this->exactly(count($performances)))->method('calculate')->willReturn($calculatedCreditVolumes);

        $performanceSummaryCalculator = new PerformancesSummaryCreator($amountCalculator, $creditVolumesCalculator);

        $performanceSummaryCalculator->createSummary($performances);
    }

    public function testCalculatesTotalAmount(): void
    {
        $amountCalculator        = $this->createMock(AmountCalculator::class);
        $creditVolumesCalculator = $this->createMock(CreditVolumesCalculator::class);

        $performances                  = $this->performances();
        $calculatedAmount              = $this->amount();
        $expectedTotalCalculatedAmount = $calculatedAmount->multiply(count($performances));

        $amountCalculator->expects($this->once())->method('calculateTotalAmount')->willReturn($expectedTotalCalculatedAmount);

        $performanceSummaryCalculator = new PerformancesSummaryCreator($amountCalculator, $creditVolumesCalculator);

        $performanceSummaryCalculator->createSummary($performances);
    }

    public function testCalculatesTotalCreditVolumes(): void
    {
        $amountCalculator        = $this->createMock(AmountCalculator::class);
        $creditVolumesCalculator = $this->createMock(CreditVolumesCalculator::class);

        $performances                = $this->performances();
        $calculatedCreditsVolumes    = $this->creditVolumes();
        $expectedTotalCreditsVolumes = $calculatedCreditsVolumes->multiply(count($performances));

        $creditVolumesCalculator->expects($this->once())->method('calculateTotalCreditVolumes')->willReturn($expectedTotalCreditsVolumes);

        $performanceSummaryCalculator = new PerformancesSummaryCreator($amountCalculator, $creditVolumesCalculator);

        $performanceSummaryCalculator->createSummary($performances);
    }

    public function testCreatedSummaryHasValidState(): void
    {
        $performances             = $this->performances();
        $calculatedAmount         = $this->amount();
        $calculatedCreditsVolumes = $this->creditVolumes();

        $expectedTotalCalculatedAmount = $calculatedAmount->multiply(count($performances));
        $expectedTotalCreditsVolumes   = $calculatedCreditsVolumes->multiply(count($performances));

        $amountCalculator        = $this->createMock(AmountCalculator::class);
        $creditVolumesCalculator = $this->createMock(CreditVolumesCalculator::class);

        $amountCalculator->expects($this->exactly(count($performances)))->method('calculate')->willReturn($calculatedAmount);
        $amountCalculator->expects($this->once())->method('calculateTotalAmount')->willReturn($expectedTotalCalculatedAmount);

        $creditVolumesCalculator->expects($this->exactly(count($performances)))->method('calculate')->willReturn($calculatedCreditsVolumes);
        $creditVolumesCalculator->expects($this->once())->method('calculateTotalCreditVolumes')->willReturn($expectedTotalCreditsVolumes);

        $performanceSummaryCalculator = new PerformancesSummaryCreator($amountCalculator, $creditVolumesCalculator);

        $performancesSummary = $performanceSummaryCalculator->createSummary($performances);

        $this->assertInstanceOf(PerformancesSummary::class, $performancesSummary);
        $this->assertInstanceOf(PerformancesSummaries::class, $performancesSummary->performancesSummaries());
        $this->assertCount(count($performances), $performancesSummary->performancesSummaries());
        $this->assertTrue($expectedTotalCreditsVolumes->areEquals($performancesSummary->totalCreditVolumes()));
        $this->assertTrue($expectedTotalCalculatedAmount->areEquals($performancesSummary->totalAmount()));
    }
}
