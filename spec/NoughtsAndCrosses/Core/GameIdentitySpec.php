<?php

namespace spec\NoughtsAndCrosses\Core;

use NoughtsAndCrosses\Core\GameIdentity;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameIdentitySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedThrough('createNew', []);
    }

    function it_has_an_identity()
    {
        $this->shouldBeLike($this);
    }

    function it_is_not_equal_to_other_ids()
    {
        $this->shouldNotBeLike(GameIdentity::createNew());
    }
}
