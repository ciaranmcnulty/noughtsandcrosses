<?php

namespace NoughtsAndCrosses\Core;

class Player
{
    const PLAYER_X = 'X';
    const PLAYER_O = 'O';

    private $player;

    private function __construct($player)
    {
        $this->player = $player;
    }

    public static function X()
    {
        return new Player(static::PLAYER_X);
    }

    public static function O()
    {
        return new Player(static::PLAYER_O);
    }
}
