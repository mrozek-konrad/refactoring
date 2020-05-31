<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\Customer;
use Theatre\Tests\Fixtures\CustomerFixtures;

class CustomerTest extends TheatreTestCase
{
    use CustomerFixtures;

    public function testCustomerNameCannotBeTooLong(): void
    {
        $name = $this->customerNameTooLong();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of name must be between %d-%d chars.', Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM)
        );

        new Customer($name);
    }

    public function testCustomerNameCannotBeTooShort(): void
    {
        $name = $this->customerNameTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of name must be between %d-%d chars.', Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM)
        );

        new Customer($name);
    }

    public function testCustomerReturnsValidName(): void
    {
        $name = $this->customerName();

        $customer = new Customer($name);

        $this->assertSame($name, $customer->name());
    }
}
