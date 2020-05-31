<?php

namespace Theatre\Tests\AmountRules;

use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;
use Theatre\Tests\TheatreTestCase;

class BonusAmountForEachViewerAboveMinimumAudienceTest extends TheatreTestCase
{
    use AmountRulesFixtures;

    public function testCalculatesCorrectBonusAmountIfAudienceIsAboveMinimumAudience(): void
    {
        $bonusAmount     = $this->amount();
        $minimumAudience = $this->audience();
        $audience        = $this->audienceAboveThan($minimumAudience);

        $audienceAboveMinimumAudience = $audience->minus($minimumAudience);
        $expectedBonusAmount          = $bonusAmount->multiply($audienceAboveMinimumAudience->value());

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
}
