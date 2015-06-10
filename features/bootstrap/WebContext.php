<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

/**
 * Defines application features from the specific context.
 */
class WebContext extends RawMinkContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @When I begin a game
     */
    public function iBeginAGame()
    {
        $this->visitPath('/');
        $this->assertSession()->statusCodeEquals(200);

        $this->getSession()->getPage()->pressButton('New Game');
    }

    /**
     * @Then the game should have begun
     */
    public function theGameShouldHaveBegun()
    {
        $this->assertSession()->addressMatches('|/game/[0-9a-zA-Z-_]+|i');
        $this->assertSession()->pageTextContains('Game created');
    }
}
