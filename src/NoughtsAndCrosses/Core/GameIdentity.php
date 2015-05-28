<?php

namespace NoughtsAndCrosses\Core;

use Rhumsaa\Uuid\Uuid;

class GameIdentity
{
    private $uuid;

    private function __construct(Uuid $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function createNew()
    {
        return new GameIdentity(Uuid::uuid4());
    }
}
