<?php

namespace spec\NoughtsAndCrosses\Infrastructure;

use NoughtsAndCrosses\Infrastructure\Event;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventBusSpec extends ObjectBehavior
{
    function it_stores_dispatched_events(Event $event)
    {
        $this->dispatch($event);
        $this->getEvents()->shouldBeLike([$event->getWrappedObject()]);
    }
}
