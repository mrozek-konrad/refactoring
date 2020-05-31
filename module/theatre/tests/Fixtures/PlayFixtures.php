<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Play;
use Theatre\Play\Id;
use Theatre\Play\Type as PlayType;
use Theatre\Plays;

trait PlayFixtures
{
    use RandomScalarValuesFixtures;

    final protected function invalidPlayParamsWithFewPlaysWithTheSameId(Play\Id $id): array
    {
        return array_merge($this->validPlaysParams($id), $this->validPlaysParams($id));
    }

    final protected function invalidPlaysParams(): array
    {
        return $this->arrayOf(fn() => $this->largeValue());
    }

    final protected function play(?Id $id = null): Play
    {
        return new Play($id ?? $this->playId(), $this->playName(), $this->playType());
    }

    final protected function playId(): Play\Id
    {
        return Play\Id::create($this->playIdValue());
    }

    final protected function playIdValue(): string
    {
        return $this->text($this->value(Play\Id::LENGTH_MINIMUM, Play\Id::LENGTH_MAXIMUM));
    }

    final protected function playIdValueTooLong(): string
    {
        return $this->textLongerThan(Play\Id::LENGTH_MAXIMUM);
    }

    final protected function playIdValueTooShort(): string
    {
        return $this->textShorterThan(Play\Id::LENGTH_MINIMUM);
    }

    final protected function playName(): string
    {
        return $this->text($this->value(Play::NAME_LENGTH_MINIMUM, Play::NAME_LENGTH_MAXIMUM));
    }

    final protected function playNameTooLong(): string
    {
        return $this->textLongerThan(Play::NAME_LENGTH_MAXIMUM);
    }

    final protected function playNameTooShort(): string
    {
        return $this->textShorterThan(Play::NAME_LENGTH_MINIMUM);
    }

    final protected function playType(): PlayType
    {
        return PlayType::create($this->typeValue());
    }

    final protected function plays(array $plays = []): Plays
    {
        $params = $this->validPlaysParams() ?? $plays;

        return new Plays(...$params);
    }

    final protected function playsWithPlay(Play $play): Plays
    {
        $params   = $this->validPlaysParams();
        $params[] = $play;

        return new Plays(...$params);
    }

    final protected function typeValue(): string
    {
        return $this->text($this->value(Play\Type::LENGTH_MINIMUM, Play\Type::LENGTH_MAXIMUM));
    }

    final protected function typeValueTooLong(): string
    {
        return $this->textLongerThan(Play\Type::LENGTH_MAXIMUM);
    }

    final protected function typeValueTooShort(): string
    {
        return $this->textShorterThan(Play\Type::LENGTH_MINIMUM);
    }

    final protected function validPlaysParams(?Play\Id $id = null): array
    {
        return $this->arrayOf(fn() => $this->play($id));
    }
}