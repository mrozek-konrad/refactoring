<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Customer;
use Theatre\Performance;
use Theatre\Performances;

trait Fixtures
{
    public function audience(): int
    {
        return $this->randomInt(Performance::AUDIENCE_LENGTH_MINIMUM, Performance::AUDIENCE_LENGTH_MAXIMUM);
    }

    public function audienceAboveMaximum(): int
    {
        return $this->randomInt(Performance::AUDIENCE_LENGTH_MAXIMUM + 1, PHP_INT_MAX);
    }

    public function audienceLowerThanMinimum(): int
    {
        return $this->randomInt(PHP_INT_MIN, Performance::AUDIENCE_LENGTH_MINIMUM - 1);
    }

    public function customerName(): string
    {
        return $this->randomString($this->randomInt(Customer::NAME_LENGTH_MINIMUM, Customer::NAME_LENGTH_MAXIMUM));
    }

    public function customerNameTooLong(): string
    {
        return $this->randomString(Customer::NAME_LENGTH_MAXIMUM + 1);
    }

    public function customerNameTooShort(): string
    {
        return $this->randomString(Customer::NAME_LENGTH_MINIMUM - 1);
    }

    public function invalidPerformanceParams(): array
    {
        return [$this->randomInt(PHP_INT_MIN, PHP_INT_MAX), $this->randomInt(PHP_INT_MIN, PHP_INT_MAX)];
    }

    public function performance(): Performance
    {
        return new Performance($this->playId(), $this->audience());
    }

    public function playId(): string
    {
        return $this->randomString($this->randomInt(Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM));
    }

    public function playIdTooLong(): string
    {
        return $this->randomString(Performance::PLAY_ID_LENGTH_MAXIMUM + 1);
    }

    public function playIdTooShort(): string
    {
        return $this->randomString(Performance::PLAY_ID_LENGTH_MINIMUM - 1);
    }

    public function validPerformanceParams(): array
    {
        $params = [];

        for ($i = 0; $i < $this->randomInt(5, 20); $i++) {
            $params[] = $this->performance();
        }

        return $params;
    }

    public function performances(): Performances
    {
        return new Performances(...$this->validPerformanceParams());
    }

    public function customer(): Customer
    {
        return new Customer($this->customerName());
    }

    private function randomInt(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }

    private function randomString(int $length): string
    {
        return substr(md5((string) mt_rand()) . md5((string) mt_rand()), 0, $length);
    }
}