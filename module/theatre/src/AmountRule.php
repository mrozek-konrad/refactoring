<?php

declare(strict_types=1);

namespace Theatre;

interface AmountRule
{
    public function calculateAmount(Audience $audience): Amount;
}