<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class AmountForEachViewerTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $amount = $this->amountLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be above zero.');

        $this->buildAmountForEachViewerRule($amount);
    }

    public function testCalculatesCorrectResult(): void
    {
        $amountForEachViewer = $this->amount();
        $audience            = $this->audience();

        $expectedAmount = $amountForEachViewer * $audience;

        $rule             = $this->buildAmountForEachViewerRule($amountForEachViewer);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertSame($expectedAmount, $calculatedAmount);
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildAmountForEachViewerRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }
}
