<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Customer;
use Theatre\Performance;

class PerformanceTest extends TestCase
{
    use Fixtures;

    public function testPerformancePlayIdCannotBeTooLong(): void
    {
        $playId   = $this->performancePlayIdTooLong();
        $audience = $this->audience();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of playId must be between %d-%d chars.', Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformancePlayIdCannotBeTooShort(): void
    {
        $playId   = $this->performancePlayIdTooShort();
        $audience = $this->audience();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of playId must be between %d-%d chars.', Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
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

    public function testPerformanceReturnsValidPlayIdAndAudience(): void
    {
        $playId   = $this->performancePlayId();
        $audience = $this->audience();

        $performance = new Performance($playId, $audience);

        $this->assertSame($playId, $performance->playId());
        $this->assertSame($audience, $performance->audience());
    }
}
