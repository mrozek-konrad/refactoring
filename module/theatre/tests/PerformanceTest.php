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
        $playId   = $this->playId();
        $audience = $this->audience();

        $performance = new Performance($playId, $audience);

        $this->assertSame($playId, $performance->playId());
        $this->assertSame($audience, $performance->audience());
    }
}
