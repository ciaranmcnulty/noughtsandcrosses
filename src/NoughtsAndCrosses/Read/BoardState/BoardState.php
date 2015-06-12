<?php

namespace NoughtsAndCrosses\Read\BoardState;

class BoardState
{
    private function __construct()
    {
    }

    public static function start()
    {
        return new static();
    }

    public function playerForSquare($argument1)
    {
        // TODO: write logic here
    }
}
