<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\MoveNotValid;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\MoveTaken;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    private $id;

    public function let()
    {
        $this->id = GameId::createNew();
        $this->beConstructedThrough('begin', [$this->id]);
    }

    function it_starts_with_a_game_created_event()
    {
        $this->getNewEvents()->shouldBeLike([new GameBegan($this->id)]);
    }

    function it_can_be_created_from_events()
    {
        $this->beConstructedThrough('fromEvents', [[new GameBegan($this->id)]]);
        $this->getNewEvents()->shouldBeLike([]);
    }

    function it_plays_move_when_move_is_valid()
    {
        $this->play(Square::atPosition('A', 1), Player::O());
        $this->getNewEvents()->shouldBeLike([
            new GameBegan($this->id),
            new MoveTaken($this->id, Square::atPosition('A', 1), Player::O())
        ]);
    }

    function it_refuses_move_when_square_is_occupied()
    {
        $this->beConstructedThrough('fromEvents', [[
            new GameBegan($this->id),
            new MoveTaken($this->id, Square::atPosition('A', 1), Player::O())
        ]]);

        $this->shouldThrow(MoveNotValid::class)->duringPlay(Square::atPosition('A', 1), Player::X());
    }
}
