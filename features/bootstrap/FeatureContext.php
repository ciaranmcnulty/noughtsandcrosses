<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use NoughtsAndCrosses\Core\CreateGame;
use NoughtsAndCrosses\Core\GameCreated;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $scenario;

    public function __construct()
    {
        $this->scenario = new ScenarioTester();
    }

    /**
     * @When I create a new game
     */
    public function iCreateANewGame()
    {
        $this->scenario->when(new CreateGame());
    }

    /**
     * @Then a new game should have been created
     */
    public function aNewGameShouldHaveBeenCreated()
    {
        $this->scenario->then([
            new GameCreated()
        ]);
    }
}
