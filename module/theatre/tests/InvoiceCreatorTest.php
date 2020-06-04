<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\InvoiceCreator;
use Theatre\PerformancesSummaryCreator;
use Theatre\Tests\Fixtures\CustomerFixtures;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class InvoiceCreatorTest extends TheatreTestCase
{
    use CustomerFixtures;
    use PerformanceFixtures;

    public function testCreatedInvoiceHasValidCustomerAndPerformancesSummary(): void
    {
        $customer     = $this->customer();
        $performances = $this->performances();

        $performancesSummary = $this->performancesSummary();

        $performancesSummaryCreator = $this->createMock(PerformancesSummaryCreator::class);
        $performancesSummaryCreator->expects($this->once())->method('createSummary')->with($performances)->willReturn($performancesSummary);

        $invoiceCreator = new InvoiceCreator($performancesSummaryCreator);

        $invoice = $invoiceCreator->create($customer, $performances);

        $this->assertSame($customer, $invoice->customer());
        $this->assertSame($performancesSummary, $invoice->performancesSummary());
    }

    public function testUsesPerformancesSummaryCreatorToCreatePerformancesSummary(): void
    {
        $customer     = $this->customer();
        $performances = $this->performances();

        $performancesSummaryCreator = $this->createMock(PerformancesSummaryCreator::class);
        $performancesSummaryCreator->expects($this->once())->method('createSummary')->with($performances);

        $invoiceCreator = new InvoiceCreator($performancesSummaryCreator);

        $invoiceCreator->create($customer, $performances);
    }
}
