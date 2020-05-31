<?php

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
        $customer     = $this->customer();
        $performances = $this->performances();

        $invoice = new Invoice($customer, $performances);

        $this->assertSame($customer, $invoice->customer());
        $this->assertSame($performances, $invoice->performances());
    }
}
