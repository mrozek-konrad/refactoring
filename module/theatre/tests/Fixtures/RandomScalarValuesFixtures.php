<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

trait RandomScalarValuesFixtures
{
    protected function randomInt(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }
}