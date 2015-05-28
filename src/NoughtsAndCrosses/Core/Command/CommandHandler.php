<?php

namespace NoughtsAndCrosses\Core\Command;

interface CommandHandler
{
    public function supports(Command $command);

    public function handle(Command $command);
}
