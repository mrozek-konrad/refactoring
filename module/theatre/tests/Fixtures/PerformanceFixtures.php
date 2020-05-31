<?php

declare(strict_types=1);

namespace Theatre\Tests\Fixtures;

use Theatre\Performance;
use Theatre\Performances;

trait PerformanceFixtures
{
    use PlayFixtures;
    use AudienceFixtures;

    final protected function invalidPerformancesParams(): array
    {
        return $this->arrayOf(fn() => $this->largeValue());
    }

    protected function performance(): Performance
    {
        return new Performance($this->play(), $this->audience());
    }

    protected function performances(): Performances
    {
        return new Performances(...$this->validPerformanceParams());
    }

    protected function validPerformanceParams(): array
    {
        return $this->arrayOf(fn() => $this->performance());
    }
}