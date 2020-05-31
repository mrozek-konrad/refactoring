<?php

declare(strict_types=1);

namespace Theatre;

use RuntimeException;

class CreditVolumesCalculator
{
    private array $creditVolumesRules = [];

    public function addCreditVolumesRules(Play\Type $playType, CreditVolumesRules $creditVolumesRules): void
    {
        $this->creditVolumesRules[$playType->value()] = $creditVolumesRules;
    }

    public function calculate(Performance $performance): CreditVolumes
    {
        $creditVolumesRules = $this->creditVolumes($performance->play()->type());

        $creditVolumes = CreditVolumes::zero();

        foreach ($creditVolumesRules as $creditVolumesRule) {
            $calculatedCreditVolumes = $creditVolumesRule->calculateCredit($performance->audience());

            $creditVolumes = $creditVolumes->add($calculatedCreditVolumes);
        }

        return $creditVolumes;
    }

    public function creditVolumes(Play\Type $playType): CreditVolumesRules
    {
        if (! array_key_exists($playType->value(), $this->creditVolumesRules)) {
            throw new RuntimeException('Credit volumes rules for play type ' . $playType->value() . ' are not set.');
        }

        return $this->creditVolumesRules[$playType->value()];
    }
}