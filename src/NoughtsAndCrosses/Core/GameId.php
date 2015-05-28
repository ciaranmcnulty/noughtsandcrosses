<?php

namespace NoughtsAndCrosses\Core;

use Rhumsaa\Uuid\Uuid;

class GameId
{
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function createNew()
    {
        return new static(Uuid::uuid4());
    }
}
