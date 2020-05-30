<?php

namespace Theatre\Tests\AmountRules;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

class BonusAmountForEachViewerAboveMinimumAudienceTest extends TestCase
{
    use AmountRulesFixtures;

    public function testCalculatesCorrectBonusAmountIfAudienceIsAboveMinimumAudience(): void
    {
        $bonusAmount     = $this->amount();
        $minimumAudience = $this->audience();
        $audience        = $this->audienceAboveThan($minimumAudience);

        $audienceAboveMinimumAudience = $audience - $minimumAudience;
        $expectedBonusAmount          = $bonusAmount->multiply($audienceAboveMinimumAudience);

        $rule             = $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule($bonusAmount, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertTrue($expectedBonusAmount->areEquals($calculatedAmount));
    }

    public function testCalculatesCorrectBonusAmountIfAudienceIsLowerThanMinimumAudience(): void
    {
        $bonusAmount     = $this->amount();
        $minimumAudience = $this->audience();
        $audience        = $this->audienceLowerThan($minimumAudience);

        $expectedBonusAmount = Amount::zero();

        $rule             = $this->buildBonusAmountForEachViewerAboveMinimumAudienceRule($bonusAmount, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audience);

        $this->assertTrue($expectedBonusAmount->areEquals($calculatedAmount));
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
