<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Customer;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\Play;

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
        return $this->randomStringTooLong(Customer::NAME_LENGTH_MAXIMUM);
    }

    public function customerNameTooShort(): string
    {
        return $this->randomStringTooShort(Customer::NAME_LENGTH_MINIMUM);
    }

    public function invalidPerformanceParams(): array
    {
        return [$this->randomInt(PHP_INT_MIN, PHP_INT_MAX), $this->randomInt(PHP_INT_MIN, PHP_INT_MAX)];
    }

    public function performance(): Performance
    {
        return new Performance($this->performancePlayId(), $this->audience());
    }

    public function performancePlayId(): string
    {
        return $this->randomString($this->randomInt(Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM));
    }

    public function playId(): string
    {
        return $this->randomString($this->randomInt(Play::ID_LENGTH_MINIMUM, Play::ID_LENGTH_MAXIMUM));
    }

    public function playIdTooShort(): string
    {
        return $this->randomStringTooShort(Play::ID_LENGTH_MINIMUM);
    }

    public function playIdTooLong(): string
    {
        return $this->randomStringTooLong(Play::ID_LENGTH_MAXIMUM);
    }

    public function playName(): string
    {
        return $this->randomString($this->randomInt(Play::NAME_LENGTH_MINIMUM, Play::NAME_LENGTH_MAXIMUM));
    }

    public function playNameTooShort(): string
    {
        return $this->randomStringTooShort(Play::NAME_LENGTH_MINIMUM);
    }

    public function playNameTooLong(): string
    {
        return $this->randomStringTooLong(Play::NAME_LENGTH_MAXIMUM);
    }

    public function playType(): string
    {
        return $this->randomString($this->randomInt(Play::TYPE_LENGTH_MINIMUM, Play::TYPE_LENGTH_MAXIMUM));
    }

    public function playTypeTooShort(): string
    {
        return $this->randomStringTooShort(Play::TYPE_LENGTH_MINIMUM);
    }

    public function playTypeTooLong(): string
    {
        return $this->randomStringTooLong(Play::TYPE_LENGTH_MAXIMUM);
    }

    public function performancePlayIdTooLong(): string
    {
        return $this->randomStringTooLong(Performance::PLAY_ID_LENGTH_MAXIMUM);
    }

    public function performancePlayIdTooShort(): string
    {
        return $this->randomStringTooShort(Performance::PLAY_ID_LENGTH_MINIMUM);
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

    private function randomStringTooShort(int $length): string
    {
        return $this->randomString($length - 1);
    }

    private function randomStringTooLong(int $length): string
    {
        return $this->randomString($length + 1);
    }

    private function randomString(int $length): string
    {
        return substr(md5((string) mt_rand()) . md5((string) mt_rand()) . md5((string) mt_rand()), 0, $length);
    }
}