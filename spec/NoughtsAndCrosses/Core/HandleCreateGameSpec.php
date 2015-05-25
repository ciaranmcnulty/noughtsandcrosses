<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\CreateGame;
use NoughtsAndCrosses\Core\GameCreated;
use NoughtsAndCrosses\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Infrastructure\EventBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HandleCreateGameSpec extends ObjectBehavior
{
    function let(EventBus $eventBus)
    {
        $this->beConstructedWith($eventBus);
    }

    function it_is_a_command_handler()
    {
        $this->shouldHaveType(CommandHandler::class);
    }

    function it_dispatches_game_created_when_handling_create_game_command(EventBus $eventBus)
    {
        $this->handle(new CreateGame());

        $eventBus->dispatch(new GameCreated())->shouldHaveBeenCalled();
    }
}
