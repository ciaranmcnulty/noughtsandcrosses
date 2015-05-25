<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\GameCreated;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedThrough('createNew');
    }

    function it_starts_with_a_game_created_event()
    {
        $this->getNewEvents()->shouldBeLike([new GameCreated()]);
    }
}
