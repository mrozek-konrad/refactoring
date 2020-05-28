<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Performance
{
    public const  PLAY_ID_LENGTH_MINIMUM  = 3;
    public const  PLAY_ID_LENGTH_MAXIMUM  = 15;
    public const  AUDIENCE_LENGTH_MINIMUM = 1;
    public const  AUDIENCE_LENGTH_MAXIMUM = 501;

    private string $playId;
    private int    $audience;

    public function __construct(string $playId, int $audience)
    {
        $playIdLength = strlen($playId);

        if ($playIdLength < self::PLAY_ID_LENGTH_MINIMUM || $playIdLength > self::PLAY_ID_LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(
                sprintf('Length of playId must be between %d-%d chars.', self::PLAY_ID_LENGTH_MINIMUM, self::PLAY_ID_LENGTH_MAXIMUM)
            );
        }

        if ($audience < self::AUDIENCE_LENGTH_MINIMUM || $audience > self::AUDIENCE_LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(
                sprintf('Audience must be above %d and lower than %d', self::AUDIENCE_LENGTH_MINIMUM, self::AUDIENCE_LENGTH_MAXIMUM)
            );
        }

        $this->playId   = $playId;
        $this->audience = $audience;
    }

    public function audience(): int
    {
        return $this->audience;
    }

    public function playId(): string
    {
        return $this->playId;
    }
}