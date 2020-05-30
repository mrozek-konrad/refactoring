<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Customer;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\Play;
use Theatre\Plays;
use Theatre\Tests\Fixtures\AmountRulesFixtures;

trait Fixtures
{
    use AmountRulesFixtures;

    public function customer(): Customer
    {
        return new Customer($this->customerName());
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

    public function invalidPlayParams(): array
    {
        return [$this->randomInt(PHP_INT_MIN, PHP_INT_MAX), $this->randomInt(PHP_INT_MIN, PHP_INT_MAX)];
    }

    public function invalidPlayParamsWithFewPlaysWithTheSameId(string $id): array
    {
        $params = [];

        for ($i = 0; $i < $this->randomInt(5, 20); $i++) {
            $params[] = $this->play($id);
        }

        return $params;
    }

    public function performance(): Performance
    {
        return new Performance($this->performancePlayId(), $this->audience());
    }

    public function performancePlayId(): string
    {
        return $this->randomString($this->randomInt(Performance::PLAY_ID_LENGTH_MINIMUM, Performance::PLAY_ID_LENGTH_MAXIMUM));
    }

    public function performancePlayIdTooLong(): string
    {
        return $this->randomStringTooLong(Performance::PLAY_ID_LENGTH_MAXIMUM);
    }

    public function performancePlayIdTooShort(): string
    {
        return $this->randomStringTooShort(Performance::PLAY_ID_LENGTH_MINIMUM);
    }

    public function performances(): Performances
    {
        return new Performances(...$this->validPerformanceParams());
    }

    public function play(?string $id = null): Play
    {
        return new Play($id ?? $this->playId(), $this->playName(), $this->playType());
    }

    public function playId(): string
    {
        return $this->randomString($this->randomInt(Play::ID_LENGTH_MINIMUM, Play::ID_LENGTH_MAXIMUM));
    }

    public function playIdTooLong(): string
    {
        return $this->randomStringTooLong(Play::ID_LENGTH_MAXIMUM);
    }

    public function playIdValueTooLong(): string
    {
        return $this->randomStringTooLong(15);
    }

    public function playIdValueTooShort(): string
    {
        return $this->randomStringTooShort(3);
    }

    public function playIdValue(): string
    {
        return $this->randomString($this->randomInt(3, 15));
    }

    public function invalidPlayId(): string
    {
        return $this->playIdTooLong();
    }

    public function playIdTooShort(): string
    {
        return $this->randomStringTooShort(Play::ID_LENGTH_MINIMUM);
    }

    public function playName(): string
    {
        return $this->randomString($this->randomInt(Play::NAME_LENGTH_MINIMUM, Play::NAME_LENGTH_MAXIMUM));
    }

    public function playNameTooLong(): string
    {
        return $this->randomStringTooLong(Play::NAME_LENGTH_MAXIMUM);
    }

    public function playNameTooShort(): string
    {
        return $this->randomStringTooShort(Play::NAME_LENGTH_MINIMUM);
    }

    public function playType(): string
    {
        return $this->randomString($this->randomInt(Play::TYPE_LENGTH_MINIMUM, Play::TYPE_LENGTH_MAXIMUM));
    }

    public function playTypeTooLong(): string
    {
        return $this->randomStringTooLong(Play::TYPE_LENGTH_MAXIMUM);
    }

    public function playTypeTooShort(): string
    {
        return $this->randomStringTooShort(Play::TYPE_LENGTH_MINIMUM);
    }

    public function plays(): Plays
    {
        $params = $this->validPlayParams();

        return new Plays(...$params);
    }

    public function playsWithPlay(Play $play): Plays
    {
        $params   = $this->validPlayParams();
        $params[] = $play;

        return new Plays(...$params);
    }

    public function validPerformanceParams(): array
    {
        $params = [];

        for ($i = 0; $i < $this->randomInt(5, 20); $i++) {
            $params[] = $this->performance();
        }

        return $params;
    }

    public function validPlayParams(): array
    {
        $params = [];

        for ($i = 0; $i < $this->randomInt(5, 20); $i++) {
            $params[] = $this->play();
        }

        return $params;
    }

    private function randomInt(int $min, int $max): int
    {
        return mt_rand($min, $max);
    }

    private function randomString(int $length): string
    {
        return substr(md5((string) mt_rand()) . md5((string) mt_rand()) . md5((string) mt_rand()), 0, $length);
    }

    private function randomStringTooLong(int $length): string
    {
        return $this->randomString($length + 1);
    }

    private function randomStringTooShort(int $length): string
    {
        return $this->randomString($length - 1);
    }
}