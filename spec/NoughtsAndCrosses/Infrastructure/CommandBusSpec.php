<?php

namespace spec\NoughtsAndCrosses\Infrastructure;

use NoughtsAndCrosses\Infrastructure\Command;
use NoughtsAndCrosses\Infrastructure\CommandHandler;
use NoughtsAndCrosses\Infrastructure\EventBus;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CommandBusSpec extends ObjectBehavior
{
    function let(EventBus $eventBus, CommandHandler $commandHandler)
    {
        $this->beConstructedWith($eventBus, [$commandHandler->getWrappedObject()]);
    }

    function it_dispatches_commands_which_have_handlers(Command $command, CommandHandler $commandHandler)
    {
        $this->dispatch($command);
        $commandHandler->handle($command)->shouldHaveBeenCalled();
    }
}
