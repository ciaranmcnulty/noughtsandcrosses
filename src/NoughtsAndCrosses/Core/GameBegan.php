<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Infrastructure\Event;

class GameBegan implements Event
{
    private $id;

    public function __construct(GameId $id)
    {
        $this->id = $id;
    }

    public function id()
    {
        return $this->id;
    }
}
