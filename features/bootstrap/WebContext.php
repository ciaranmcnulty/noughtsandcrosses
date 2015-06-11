<?php

use Behat\Behat\Context\SnippetAcceptingContext;
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
     * @Given a game has already begun
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

    /**
     * @When I play the :square square as the :player player
     */
    public function iPlayTheMiddleSquareAsThePlayer($square, $player)
    {
        $this->getSession()->getPage()->selectFieldOption("player", $player);
        $this->getSession()->getPage()->pressButton("square-$square");
    }

    /**
     * @Then the :square square should have been played with an :player
     */
    public function theMiddleSquareShouldHaveBeenPlayedWithAn($square, $player)
    {
        $this->assertSession()->elementTextContains('css', "#square-$square", $player);
    }
}
