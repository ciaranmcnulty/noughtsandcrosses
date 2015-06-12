<?php

namespace spec\NoughtsAndCrosses\Read\BoardState;

use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\Infrastructure\EventListener;
use NoughtsAndCrosses\Core\MoveTaken;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Read\BoardState\BoardState;
use NoughtsAndCrosses\Read\BoardState\BoardStateRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BoardStateProjectorSpec extends ObjectBehavior
{
    function let(BoardStateRepository $boardStateRepository)
    {
        $this->beConstructedWith($boardStateRepository);
    }

    function it_is_an_event_listener()
    {
        $this->shouldHaveType(EventListener::class);
    }

    function it_creates_the_board_state_when_the_game_begins(BoardStateRepository $boardStateRepository)
    {
        $id = GameId::createNew();

        $this->handle(new GameBegan($id));

        $boardStateRepository->add($id, BoardState::start())->shouldHaveBeenCalled();
    }

}
