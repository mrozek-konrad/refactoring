<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

trait RandomScalarValuesFixtures
{
    abstract protected function arrayOf(callable $elementHandler): array;

    abstract protected function largeValue(): int;

    abstract protected function mediumValue(): int;

    abstract protected function one(): int;

    abstract protected function smallValue(): int;

    abstract protected function text(int $length): string;

    abstract protected function textLongerThan(int $length): string;

    abstract protected function textShorterThan(int $length): string;

    abstract protected function tinyValue(): int;

    abstract protected function value(int $min, int $max): int;

    abstract protected function valueGreaterThan(int $greaterThan, int $max = null): int;

    abstract protected function valueLowerThan(int $lowerThan, int $min = null): int;

    abstract protected function zero(): int;
}