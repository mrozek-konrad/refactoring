<?php

declare(strict_types=1);

namespace Theatre;

use InvalidArgumentException;

class Performance
{
    public const  PLAY_ID_LENGTH_MINIMUM = 3;
    public const  PLAY_ID_LENGTH_MAXIMUM = 15;

    private string   $playId;
    private Audience $audience;

    public function __construct(string $playId, Audience $audience)
    {
        $playIdLength = strlen($playId);

        if ($playIdLength < self::PLAY_ID_LENGTH_MINIMUM || $playIdLength > self::PLAY_ID_LENGTH_MAXIMUM) {
            throw new InvalidArgumentException(
                sprintf('Length of playId must be between %d-%d chars.', self::PLAY_ID_LENGTH_MINIMUM, self::PLAY_ID_LENGTH_MAXIMUM)
            );
        }
        $this->playId   = $playId;
        $this->audience = $audience;
    }

    public function audience(): Audience
    {
        return $this->audience;
    }

    public function playId(): string
    {
        return $this->playId;
    }
}