<?php

namespace Theatre\Tests;

use PHPUnit\Framework\TestCase;
use Theatre\Invoice;

class InvoiceTest extends TestCase
{
    use Fixtures;

    public function testInvoiceCanBeBuildCorrectly(): void
    {
        $customer     = $this->customer();
        $performances = $this->performances();

        $invoice = new Invoice($customer, $performances);

        $this->assertSame($customer, $invoice->customer());
        $this->assertSame($performances, $invoice->performances());
    }
}
