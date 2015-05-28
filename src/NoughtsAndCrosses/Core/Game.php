<?php

namespace NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Event\Event;

class Game
{
    private $events = [];

    private $id;

    private function __construct(){}

    public static function begin(GameIdentity $identity)
    {
        $game = new static();
        $game->apply(new GameHasBegun($identity));

        return $game;
    }

    public static function fromEvents(array $events)
    {
        $game = new static();

        foreach ($events as $event) {
            $game->apply($event);
        }

        $game->events = [];

        return $game;
    }

    public function getNewEvents()
    {
        return $this->events;
    }

    public function play(Square $square, Player $player)
    {
        $this->apply(new SquarePlayedByPlayer($this->id, $square, $player));
    }

    private function apply(Event $event)
    {
        if ($event instanceof GameHasBegun)
        {
            $this->id = $event->id();
        }

        $this->events[] = $event;
    }
}
