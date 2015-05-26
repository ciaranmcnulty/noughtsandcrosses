<?php

namespace NoughtsAndCrosses\Core\Command;

interface CommandBus
{
    public function dispatch(Command $command);
}