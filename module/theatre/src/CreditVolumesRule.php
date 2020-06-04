<?php

declare(strict_types=1);

namespace Theatre;

interface CreditVolumesRule
{
    public function calculateCredit(Audience $audience): CreditVolumes;
}
