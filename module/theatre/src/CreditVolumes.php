<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class CreditVolumes
{
    private int $creditVolumes;

    public function __construct(int $creditVolumes)
    {
        if ($creditVolumes < 0) {
            throw new InvalidArgumentException('Credit volumes cannot be less than zero');
        }
        
        $this->creditVolumes = $creditVolumes;
    }

    public static function create(int $creditVolumes): CreditVolumes
    {
        return new self($creditVolumes);
    }

    public static function zero(): CreditVolumes
    {
        return new self(0);
    }

    public function add(CreditVolumes $creditVolumesToAdd): CreditVolumes
    {
        return new self($this->creditVolumes + $creditVolumesToAdd->value());
    }

    public function multiply(int $value): CreditVolumes
    {
        return new self($this->creditVolumes * $value);
    }

    public function value(): int
    {
        return $this->creditVolumes;
    }
}