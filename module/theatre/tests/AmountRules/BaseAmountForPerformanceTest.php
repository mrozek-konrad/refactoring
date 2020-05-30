<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BaseAmountForPerformanceTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $amountForPerformance = $this->amountLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount for performance must be above zero.');

        $this->buildBaseAmountForPerformanceRule($amountForPerformance);
    }

    public function testCalculatesCorrectResult(): void
    {
        $amountForPerformance = $this->amount();
        $audience            = $this->audience();

        $rule             = $this->buildBaseAmountForPerformanceRule($amountForPerformance);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertSame($amountForPerformance, $calculatedAmount);
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBaseAmountForPerformanceRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }
}
