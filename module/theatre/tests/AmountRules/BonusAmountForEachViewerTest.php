<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BonusAmountForEachViewerTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $bonusAmountForEachViewer = $this->amountLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus amount for each viewer must be above zero.');

        $this->buildBonusAmountForEachViewerRule($bonusAmountForEachViewer);
    }

    public function testCalculatesCorrectResult(): void
    {
        $bonusAmountForEachViewer = $this->amount();
        $audience                 = $this->audience();

        $expectedBonusAmount = $bonusAmountForEachViewer * $audience;

        $rule             = $this->buildBonusAmountForEachViewerRule($bonusAmountForEachViewer);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertSame($expectedBonusAmount, $calculatedAmount);
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusAmountForEachViewerRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }
}
