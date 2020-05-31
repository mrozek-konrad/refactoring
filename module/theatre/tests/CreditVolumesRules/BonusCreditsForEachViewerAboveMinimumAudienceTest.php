<?php

namespace Theatre\Tests\CreditVolumesRules;

use Theatre\CreditVolumes;
use Theatre\CreditVolumesRule;
use Theatre\Tests\Fixtures\CreditVolumesRulesFixtures;
use Theatre\Tests\TheatreTestCase;

class BonusCreditsForEachViewerAboveMinimumAudienceTest extends TheatreTestCase
{
    use CreditVolumesRulesFixtures;

    public function testCalculatesCorrectCreditVolumesIfAudienceIsAboveMinimumAudience(): void
    {
        $bonusCreditVolumes = $this->creditVolumes();
        $minimumAudience    = $this->audience();
        $audience           = $this->audienceAboveThan($minimumAudience);

        $audienceAboveMinimumAudience = $audience->minus($minimumAudience);
        $expectedBonusCreditVolumes   = $bonusCreditVolumes->multiply($audienceAboveMinimumAudience->value());

        $rule             = $this->buildBonusCreditsForEachViewerAboveMinimumAudienceRule($bonusCreditVolumes, $minimumAudience);
        $calculatedAmount = $rule->calculateCredit($audience);

        $this->assertTrue($expectedBonusCreditVolumes->areEquals($calculatedAmount));
    }

    public function testCalculatesCorrectCreditVolumesIfAudienceIsLowerThanMinimumAudience(): void
    {
        $bonusCreditVolumes = $this->creditVolumes();
        $minimumAudience    = $this->audience();
        $audience           = $this->audienceLowerThan($minimumAudience);

        $expectedBonusCreditVolumes = CreditVolumes::zero();

        $rule             = $this->buildBonusCreditsForEachViewerAboveMinimumAudienceRule($bonusCreditVolumes, $minimumAudience);
        $calculatedAmount = $rule->calculateCredit($audience);

        $this->assertTrue($expectedBonusCreditVolumes->areEquals($calculatedAmount));
    }

    public function testIsTypeOfAmountRule(): void
    {
        $rule = $this->buildBonusCreditsForEachViewerAboveMinimumAudienceRule();

        $this->assertInstanceOf(CreditVolumesRule::class, $rule);
    }
}
