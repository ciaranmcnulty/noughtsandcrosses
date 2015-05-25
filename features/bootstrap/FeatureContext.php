<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use NoughtsAndCrosses\Core\CreateGame;
use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameCreated;
use NoughtsAndCrosses\Core\HandleCreateGame;
use NoughtsAndCrosses\Infrastructure\CommandBus;
use NoughtsAndCrosses\Infrastructure\EventBus;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $game;

    private $commandBus;

    public function __construct()
    {
        $this->eventBus = new EventBus();
        $this->commandBus = new CommandBus($this->eventBus, [
            new HandleCreateGame($this->eventBus)
        ]);
    }

    /**
     * @When I create a new game
     */
    public function iCreateANewGame()
    {
        $command = new CreateGame();
        $this->commandBus->dispatch($command);
        $this->game = Game::createNew();
    }

    /**
     * @Then a new game should have been created
     */
    public function aNewGameShouldHaveBeenCreated()
    {
       expect($this->eventBus->getEvents())->toBeLike([new GameCreated()]);
    }
}
