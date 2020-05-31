<?php

namespace Theatre\Tests\AmountRules;

use Theatre\Amount;
use Theatre\AmountRule;
use Theatre\Tests\Fixtures\AmountRulesFixtures;
use Theatre\Tests\TheatreTestCase;

class BonusAmountForAudienceAboveMinimumAudienceTest extends TheatreTestCase
{
    use AmountRulesFixtures;

    public function testCalculatesCorrectResultIfAudienceIsAboveMinimum(): void
    {
        $minimumAudience                     = $this->audience();
        $audienceAboveThanMinimumAudience    = $this->audienceAboveThan($minimumAudience);
        $bonusAmountIfAudienceIsAboveMinimum = $this->amount();

        $rule             = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule($bonusAmountIfAudienceIsAboveMinimum, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audienceAboveThanMinimumAudience);

        $this->assertTrue($bonusAmountIfAudienceIsAboveMinimum->areEquals($calculatedAmount));
    }

    public function testCalculatesCorrectResultIfAudienceIsLowerThanMinimum(): void
    {
        $minimumAudience                     = $this->audience();
        $audienceLowerThanMinimumAudience    = $this->audienceLowerThan($minimumAudience);
        $bonusAmountIfAudienceIsAboveMinimum = $this->amount();

        $rule             = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule($bonusAmountIfAudienceIsAboveMinimum, $minimumAudience);
        $calculatedAmount = $rule->calculateAmount($audienceLowerThanMinimumAudience);

        $this->assertTrue(Amount::zero()->areEquals($calculatedAmount));
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusAmountForAudienceAboveThanMinimumAudienceRule();

        $this->assertInstanceOf(AmountRule::class, $rule);
    }
}
