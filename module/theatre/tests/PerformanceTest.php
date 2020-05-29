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
        $audience = $this->performanceAudience();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of playId must be between %d-%d chars.', Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformancePlayIdCannotBeTooShort(): void
    {
        $playId   = $this->performancePlayIdTooShort();
        $audience = $this->performanceAudience();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of playId must be between %d-%d chars.', Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformanceAudienceCannotBeAboveMaximum(): void
    {
        $playId   = $this->performancePlayId();
        $audience = $this->audienceAboveMaximum();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Audience must be above %d and lower than %d', Performance::AUDIENCE_LENGTH_MINIMUM, Performance::AUDIENCE_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformanceAudienceCannotBeLowerThanMinimum(): void
    {
        $playId   = $this->performancePlayId();
        $audience = $this->audienceLowerThanMinimum();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Audience must be above %d and lower than %d', Performance::AUDIENCE_LENGTH_MINIMUM, Performance::AUDIENCE_LENGTH_MAXIMUM)
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
        $audience = $this->performanceAudience();

        $performance = new Performance($playId, $audience);

        $this->assertSame($playId, $performance->playId());
        $this->assertSame($audience, $performance->audience());
    }
}
