<?php

namespace NoughtsAndCrosses\Core\Command;

interface CommandHandler
{
    public function handle(Command $command);
}
