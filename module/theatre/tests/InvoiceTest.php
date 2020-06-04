<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Invoice;
use Theatre\Tests\Fixtures\CustomerFixtures;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class InvoiceTest extends TheatreTestCase
{
    use CustomerFixtures;
    use PerformanceFixtures;

    public function testInvoiceCanBeBuildCorrectly(): void
    {
        $customer            = $this->customer();
        $performancesSummary = $this->performancesSummary();

        $invoice = new Invoice($customer, $performancesSummary);

        $this->assertSame($customer, $invoice->customer());
        $this->assertSame($performancesSummary, $invoice->performancesSummary());
    }
}
