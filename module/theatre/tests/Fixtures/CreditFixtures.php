<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Credit;

trait CreditFixtures
{
    use RandomScalarValuesFixtures;

    final protected function credit(): Credit
    {
        return Credit::create($this->creditValue());
    }

    final protected function creditValue(): int
    {
        return $this->mediumValue();
    }

    final protected function creditValueGreaterThan($credit): int
    {
        return $this->valueGreaterThan($credit);
    }

    final protected function creditValueLessThan($credit): int
    {
        return $this->valueLowerThan($credit, $this->zero());
    }

    final protected function creditValueLessThanZero(): int
    {
        return $this->valueLowerThan($this->zero());
    }
}