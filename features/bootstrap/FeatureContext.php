<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use NoughtsAndCrosses\Core\Game;
use NoughtsAndCrosses\Core\GameCreated;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $game;

    /**
     * @When I create a new game
     */
    public function iCreateANewGame()
    {
        $this->game = Game::createNew();
    }

    /**
     * @Then a new game should have been created
     */
    public function aNewGameShouldHaveBeenCreated()
    {
       expect($this->game->getNewEvents())->toBeLike(
           [
               new GameCreated()
           ]
       );
    }
}
