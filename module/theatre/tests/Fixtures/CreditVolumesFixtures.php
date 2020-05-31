<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\CreditVolumes;

trait CreditVolumesFixtures
{
    use RandomScalarValuesFixtures;

    final protected function creditVolumes(?int $value = null): CreditVolumes
    {
        return CreditVolumes::create($value ?? $this->creditVolumesValue());
    }

    final protected function creditVolumesValue(): int
    {
        return $this->mediumValue();
    }

    final protected function creditVolumesValueGreaterThan($credit): int
    {
        return $this->valueGreaterThan($credit);
    }

    final protected function creditVolumesValueLessThan($credit): int
    {
        return $this->valueLowerThan($credit, $this->zero());
    }

    final protected function creditVolumesValueLessThanZero(): int
    {
        return $this->valueLowerThan($this->zero());
    }
}