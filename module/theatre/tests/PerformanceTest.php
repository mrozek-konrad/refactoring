<?php

declare(strict_types=1);

namespace Theatre\Tests;

use Theatre\Performance;
use Theatre\Tests\Fixtures\PerformanceFixtures;

class PerformanceTest extends TheatreTestCase
{
    use PerformanceFixtures;

    public function testPerformanceReturnsValidPlayIdAndAudience(): void
    {
        $play     = $this->play();
        $audience = $this->audience();

        $performance = new Performance($play, $audience);

        $this->assertSame($play, $performance->play());
        $this->assertSame($audience, $performance->audience());
    }
}
