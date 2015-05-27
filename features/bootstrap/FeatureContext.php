<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\GameHasBegun;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $scenario;

    public function __construct()
    {
        $this->scenario = new ScenarioTester();
    }

    /**
     * @When I begin a game
     */
    public function iBeginAGame()
    {
        $this->scenario->when(new BeginGame());
    }

    /**
     * @Then the game should have begun
     */
    public function theGameShouldHaveBegun()
    {
        $this->scenario->then([
            new GameHasBegun()
        ]);
    }
}
