<?php

declare(strict_types=1);

namespace Theatre\Tests;

use PHPUnit\Framework\TestCase;
use Theatre\Tests\Fixtures\RandomScalarValuesFixtures;

abstract class TheatreTestCase extends TestCase
{
    use RandomScalarValuesFixtures;

    protected function arrayOf(callable $elementHandler): array
    {
        $params = [];

        for ($i = 0; $i < $this->tinyValue(); ++$i) {
            $params[] = $elementHandler();
        }

        return $params;
    }

    protected function largeValue(): int
    {
        return $this->value($this->one(), 100_000_000_000);
    }

    protected function mediumValue(): int
    {
        return $this->value($this->one(), 100_000_000);
    }

    protected function one(): int
    {
        return 1;
    }

    protected function smallValue(): int
    {
        return $this->value($this->one(), 100_000);
    }

    protected function text(int $length): string
    {
        return substr(md5((string) mt_rand()) . md5((string) mt_rand()) . md5((string) mt_rand()), 0, $length);
    }

    protected function textLongerThan(int $length): string
    {
        return $this->text($length + 1);
    }

    protected function textShorterThan(int $length): string
    {
        return $this->text($length - 1);
    }

    protected function tinyValue(): int
    {
        return $this->value($this->one(), 100);
    }

    protected function value(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }

    protected function valueGreaterThan(int $greaterThan, ?int $max = null): int
    {
        return mt_rand($greaterThan, $max ?? $this->largeValue());
    }

    protected function valueLowerThan(int $lowerThan, ?int $min = null): int
    {
        return mt_rand(-($min ?? $this->largeValue()), $lowerThan);
    }

    protected function zero(): int
    {
        return 0;
    }
}
