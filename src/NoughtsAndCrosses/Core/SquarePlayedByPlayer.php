<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;

class SquarePlayedByPlayer implements Event
{
    private $id;

    private $square;

    private $player;

    public function __construct(GameIdentity $id, Square $square, Player $player)
    {
        $this->id = $id;
        $this->square = $square;
        $this->player = $player;
    }

    public function id()
    {
        return $this->id;
    }

    public function square()
    {
        return $this->square;
    }

    public function player()
    {
        return $this->player;
    }
}
