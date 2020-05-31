<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\AmountCalculator;
use Theatre\AmountRule;
use Theatre\AmountRules;
use Theatre\Play;

trait AmountCalculatorFixtures
{
    use RandomScalarValuesFixtures;
    use PerformanceFixtures;
    use AmountFixtures;

    final public function amountCalculator(): AmountCalculator
    {
        return new AmountCalculator();
    }

    final public function amountCalculatorWithRulesForPlayType(Play\Type $type, AmountRules $amountRules): AmountCalculator
    {
        $amountCalculator = $this->amountCalculator();
        $amountCalculator->addAmountRules($type, $amountRules);

        return $amountCalculator;
    }

    final protected function amountRules(callable $amountRuleProvider = null)
    {
        return new AmountRules(... $this->arrayOf($amountRuleProvider ?? fn() => $this->createMock(AmountRule::class)));
    }
}