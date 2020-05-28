<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Customer;
use Theatre\Performance;

class PerformanceTest extends TestCase
{
    use Fixtures;

    public function testPerformancePlayIdCannotBeTooLong()
    {
        $playId   = $this->playIdTooLong();
        $audience = $this->audience();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of playId must be between %d-%d chars.', Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformancePlayIdCannotBeTooShort()
    {
        $playId   = $this->playIdTooShort();
        $audience = $this->audience();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of playId must be between %d-%d chars.', Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformanceAudienceCannotBeAboveMaximum()
    {
        $playId   = $this->playId();
        $audience = $this->audienceAboveMaximum();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Audience must be above %d and lower than %d', Performance::AUDIENCE_LENGTH_MINIMUM, Performance::AUDIENCE_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testPerformanceAudienceCannotBeLowerThanMinimum()
    {
        $playId   = $this->playId();
        $audience = $this->audienceLowerThanMinimum();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Audience must be above %d and lower than %d', Performance::AUDIENCE_LENGTH_MINIMUM, Performance::AUDIENCE_LENGTH_MAXIMUM)
        );

        new Performance($playId, $audience);
    }

    public function testCustomerNameCannotBeTooShort()
    {
        $name = $this->customerNameTooShort();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            sprintf('Length of name must be between %d-%d chars.', Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM)
        );

        new Customer($name);
    }

    public function testPerformanceReturnsValidPlayIdAndAudience()
    {
        $playId   = $this->playId();
        $audience = $this->audience();

        $performance = new Performance($playId, $audience);

        $this->assertSame($playId, $performance->playId());
        $this->assertSame($audience, $performance->audience());
    }
}
