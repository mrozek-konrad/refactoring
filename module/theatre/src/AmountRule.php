<?php

declare(strict_types=1);

namespace Theatre;

interface AmountRule
{
    public function calculateAmount(int $audience): Amount;
}