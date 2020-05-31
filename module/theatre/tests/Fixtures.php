<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Customer;
use Theatre\Performance;
use Theatre\Performances;
use Theatre\Play;
use Theatre\Play\Id;
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

    public function invalidPlayParamsWithFewPlaysWithTheSameId(Id $id): array
    {
        $params = [];

        for ($i = 0; $i < $this->randomInt(5, 20); $i++) {
            $params[] = $this->play($id);
        }

        return $params;
    }

    public function performance(): Performance
    {
        return new Performance($this->playId(), $this->audience());
    }

    public function performances(): Performances
    {
        return new Performances(...$this->validPerformanceParams());
    }

    public function play(?Id $id = null): Play
    {
        return new Play($id ?? $this->playId(), $this->playName(), $this->playType());
    }

    public function playId(): Id
    {
        return Id::create($this->playIdValue());
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

    public function typeValueTooLong(): string
    {
        return $this->randomStringTooLong(Play\Type::LENGTH_MAXIMUM);
    }

    public function typeValueTooShort(): string
    {
        return $this->randomStringTooShort(Play\Type::LENGTH_MINIMUM);
    }

    public function typeValue(): string
    {
        return $this->randomString($this->randomInt(Play\Type::LENGTH_MINIMUM, Play\Type::LENGTH_MAXIMUM));
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

    public function plays(array $plays = []): Plays
    {
        $params = $this->validPlayParams() ?? $plays;

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