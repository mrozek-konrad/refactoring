<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\CreditVolumesCalculator;
use Theatre\CreditVolumesRule;
use Theatre\CreditVolumesRules;
use Theatre\Play;

trait CreditVolumesCalculatorFixtures
{
    use RandomScalarValuesFixtures;
    use PerformanceFixtures;
    use CreditVolumesFixtures;

    final public function creditVolumesCalculatorWithRulesForPlayType(Play\Type $type, CreditVolumesRules $creditVolumesRules): CreditVolumesCalculator
    {
        $amountCalculator = $this->creditVolumesCalculator();
        $amountCalculator->addCreditVolumesRules($type, $creditVolumesRules);

        return $amountCalculator;
    }

    final public function creditVolumesCalculator(): CreditVolumesCalculator
    {
        return new CreditVolumesCalculator();
    }

    final protected function creditVolumesRules(?callable $creditVolumesRuleProvider = null)
    {
        return new CreditVolumesRules(...$this->arrayOf($creditVolumesRuleProvider ?? fn () => $this->createMock(CreditVolumesRule::class)));
    }
}
