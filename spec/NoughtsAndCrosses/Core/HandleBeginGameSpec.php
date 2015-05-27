<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\Command\CommandHandler;
use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\GameHasBegun;
use NoughtsAndCrosses\Infrastructure\InMemory\EventBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandleBeginGameSpec extends ObjectBehavior
{
    function let(EventBus $eventBus)
    {
        $this->beConstructedWith($eventBus);
    }

    function it_is_a_command_handler()
    {
        $this->shouldHaveType(CommandHandler::class);
    }

    function it_dispatches_game_has_begun_when_handling_create_game_command(EventBus $eventBus)
    {
        $this->handle(new BeginGame());

        $eventBus->dispatch(new GameHasBegun())->shouldHaveBeenCalled();
    }
}
