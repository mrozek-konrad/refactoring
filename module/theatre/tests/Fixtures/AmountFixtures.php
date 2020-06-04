<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Amount;

trait AmountFixtures
{
    use RandomScalarValuesFixtures;

    final protected function amount(): Amount
    {
        return Amount::create($this->amountValue());
    }

    final protected function amountValue(): int
    {
        return $this->mediumValue();
    }

    final protected function amountValueGreaterThan($amount): int
    {
        return $this->valueGreaterThan($amount);
    }

    final protected function amountValueLessThan($amount): int
    {
        return $this->valueLowerThan($amount, $this->zero());
    }

    final protected function amountValueLessThanZero(): int
    {
        return $this->valueLowerThan($this->zero());
    }
}
