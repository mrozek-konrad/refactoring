<?php

declare(strict_types=1);

namespace Theatre;

class Invoice
{
    private Customer     $customer;
    private Performances $performances;

    public function __construct(Customer $customer, Performances $performances)
    {
        $this->customer     = $customer;
        $this->performances = $performances;
    }

    public function customer(): Customer
    {
        return $this->customer;
    }

    public function performances(): Performances
    {
        return $this->performances;
    }
}