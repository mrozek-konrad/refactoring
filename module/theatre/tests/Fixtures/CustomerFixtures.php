<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Customer;

trait CustomerFixtures
{
    use RandomScalarValuesFixtures;

    public function customer(): Customer
    {
        return new Customer($this->customerName());
    }

    public function customerName(): string
    {
        return $this->text($this->value(Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM));
    }

    public function customerNameTooLong(): string
    {
        return $this->textLongerThan(Customer::NAME_LENGTH_MAXIMUM);
    }

    public function customerNameTooShort(): string
    {
        return $this->textShorterThan(Customer::NAME_LENGTH_MINIMUM);
    }
}
