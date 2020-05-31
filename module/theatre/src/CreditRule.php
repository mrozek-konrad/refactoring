<?php

declare(strict_types=1);

namespace Theatre;

interface CreditRule
{
    public function calculateCredit(Audience $audience): Credit;
}