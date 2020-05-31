<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Customer;
use Theatre\Performance;

class PerformanceTest extends TestCase
{
    use Fixtures;

    public function testCustomerNameCannotBeTooShort(): void
    {
        $name = $this->customerNameTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of name must be between %d-%d chars.', Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM)
        );

        new Customer($name);
    }

    public function testPerformanceReturnsValidPlayIdAndAudience(): void
    {
        $play     = $this->play();
        $audience = $this->audience();

        $performance = new Performance($play, $audience);

        $this->assertSame($play, $performance->play());
        $this->assertSame($audience, $performance->audience());
    }
}
