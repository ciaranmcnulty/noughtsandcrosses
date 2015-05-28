<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\GameHasBegun;
use NoughtsAndCrosses\Core\GameIdentity;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\PlaySquareByPlayer;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\SquarePlayedByPlayer;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $scenario;

    private $gameIdentity;

    public function __construct()
    {
        $this->scenario = new ScenarioTester();
    }

    /**
     * @When I begin a game
     */
    public function iBeginAGame()
    {
        $this->gameIdentity = GameIdentity::createNew();
        $this->scenario->when(new BeginGame($this->gameIdentity));
    }

    /**
     * @Then the game should have begun
     */
    public function theGameShouldHaveBegun()
    {
        $this->scenario->then([
            new GameHasBegun($this->gameIdentity)
        ]);
    }

    /**
     * @Given a game has begun
     */
    public function aGameHasBegun()
    {
        $this->gameIdentity = GameIdentity::createNew();
        $this->scenario->given([
            new GameHasBegun($this->gameIdentity)
        ]);
    }

    /**
     * @When I play the :square square as the :player player
     */
    public function iPlayTheMiddleSquareAsThePlayer(Square $square, Player $player)
    {
        $this->scenario->when(
            new PlaySquareByPlayer($this->gameIdentity, $square, $player)
        );
    }

    /**
     * @Then the :square square should have been played with an :player
     */
    public function theSquareShouldHaveBeenPlayedWithAn(Square $square, Player $player)
    {
        $this->scenario->then([
            new SquarePlayedByPlayer($this->gameIdentity, $square, $player)
        ]);
    }

    /**
     * @Transform :square
     */
    public function transformSquare($string)
    {
        if ('middle' == $string) {
            return Square::atPosition("B", 2);
        }
        else {
            throw new \RuntimeException("Unknown square position '$string'");
        }
    }

    /**
     * @Transform :player
     */
    public function transformPlayer($string)
    {
        if ("X" == $string) {
            return Player::X();
        }
        elseif ("O" == $string) {
            return Player::O();
        }
        else {
            throw new \RuntimeException("Unknown player '$string'");
        }
    }
}
