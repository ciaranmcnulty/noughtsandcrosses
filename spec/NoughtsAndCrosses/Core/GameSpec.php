<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\GameHasBegun;
use NoughtsAndCrosses\Core\GameIdentity;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\SquarePlayedByPlayer;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    private $id;

    public function let()
    {
        $this->id = GameIdentity::createNew();
        $this->beConstructedThrough('begin', [$this->id]);
    }

    function it_starts_with_a_game_created_event()
    {
        $this->getNewEvents()->shouldBeLike([new GameHasBegun($this->id)]);
    }

    function it_can_be_created_from_events()
    {
        $this->beConstructedThrough('fromEvents', [[new GameHasBegun($this->id)]]);
        $this->getNewEvents()->shouldBeLike([]);
    }

    function it_plays_move_when_move_is_valid()
    {
        $this->play(Square::atPosition('A', 1), Player::O());
        $this->getNewEvents()->shouldBeLike([
            new GameHasBegun($this->id),
            new SquarePlayedByPlayer($this->id, Square::atPosition('A', 1), Player::O())
        ]);
    }
}
