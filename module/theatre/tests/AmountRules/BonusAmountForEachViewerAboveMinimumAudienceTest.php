<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BonusAmountForEachViewerAboveMinimumAudienceTest extends TestCase
{
    use AmountRulesFixtures;

    public function testAmountMustBeAboveZero(): void
    {
        $bonusAmount = $this->amountLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Bonus amount for each viewer above minimum audience must be above zero.');

        $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule($bonusAmount);
    }

    public function testCalculatesCorrectBonusAmountIfAudienceIsAboveMinimumAudience(): void
    {
        $bonusAmount     = $this->amount();
        $minimumAudience = $this->audience();
        $audience        = $this->audienceAboveThan($minimumAudience);

        $audienceAboveMinimumAudience = $audience - $minimumAudience;
        $expectedBonusAmount          = $audienceAboveMinimumAudience * $bonusAmount;

        $rule             = $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule($bonusAmount, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertSame($expectedBonusAmount, $calculatedAmount);
    }

    public function testCalculatesCorrectBonusAmountIfAudienceIsLowerThanMinimumAudience(): void
    {
        $bonusAmount     = $this->amount();
        $minimumAudience = $this->audience();
        $audience        = $this->audienceLowerThan($minimumAudience);

        $expectedBonusAmount = 0;

        $rule             = $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule($bonusAmount, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertSame($expectedBonusAmount, $calculatedAmount);
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }

    public function testMinimumAudienceMustBeAboveZero(): void
    {
        $bonusAmount                      = $this->amount();
        $minimumAudienceLowerOrEqualsZero = $this->audienceLowerOrEqualsZero();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Minimum audience must be above zero.');

        $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule($bonusAmount, $minimumAudienceLowerOrEqualsZero);
    }
}
