<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Customer;

class CustomerTest extends TestCase
{
    use Fixtures;

    public function testCustomerNameCannotBeTooShort()
    {
        $name = $this->customerNameTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of name must be between %d-%d chars.', Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM)
        );

        new Customer($name);
    }

    public function testCustomerNameCannotBeTooLong()
    {
        $name = $this->customerNameTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of name must be between %d-%d chars.', Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM)
        );

        new Customer($name);
    }

    public function testCustomerReturnsValidName()
    {
        $name = $this->customerName();

        $customer = new Customer($name);

        $this->assertSame($name, $customer->name());
    }
}
