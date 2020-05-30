<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

trait RandomScalarValuesFixtures
{
    protected function randomInt(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }

    protected function randomString(int $length): string
    {
        return substr(md5((string) mt_rand()) . md5((string) mt_rand()) . md5((string) mt_rand()), 0, $length);
    }

    protected function randomStringTooLong(int $length): string
    {
        return $this->randomString($length + 1);
    }

    protected function randomStringTooShort(int $length): string
    {
        return $this->randomString($length - 1);
    }
}