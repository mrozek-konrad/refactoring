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

    public static function create(int $creditVolumes): self
    {
        return new self($creditVolumes);
    }

    public static function zero(): self
    {
        return new self(0);
    }

    public function add(self $creditVolumesToAdd): self
    {
        return new self($this->creditVolumes + $creditVolumesToAdd->value());
    }

    public function areEquals(self $calculatedAmount): bool
    {
        return $this->creditVolumes === $calculatedAmount->creditVolumes;
    }

    public function multiply(int $value): self
    {
        return new self($this->creditVolumes * $value);
    }

    public function value(): int
    {
        return $this->creditVolumes;
    }
}
