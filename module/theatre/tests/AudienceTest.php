<?php

namespace Theatre\Tests;

use InvalidArgumentException;
use Theatre\Audience;
use PHPUnit\Framework\TestCase;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class AudienceTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountCannotBeLessThanZero(): void
    {
        $audienceValueLowerOrEqualsZero = $this->audienceValueLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Audience must be greater than zero');

        Audience::create($audienceValueLowerOrEqualsZero);
    }

    public function testCreatedAudienceContainsValidAudienceValue(): void
    {
        $audienceValue = $this->audienceValue();

        $audience = Audience::create($audienceValue);

        $this->assertInstanceOf(Audience::class, $audience);
        $this->assertSame($audienceValue, $audience->value());
    }
}
