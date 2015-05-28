<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\GameBegan;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\MoveNotValid;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\TakeMove;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\MoveTaken;

class FeatureContext implements Context, SnippetAcceptingContext
{
    private $scenario;

    private $gameIdentity;

    private $exception;

    public function __construct()
    {
        $this->scenario = new ScenarioTester();
    }

    /**
     * @When I begin a game
     */
    public function iBeginAGame()
    {
        $this->gameIdentity = GameId::createNew();
        $this->scenario->when(new BeginGame($this->gameIdentity));
    }

    /**
     * @Then the game should have begun
     */
    public function theGameShouldHaveBegun()
    {
        $this->scenario->then([
            new GameBegan($this->gameIdentity)
        ]);
    }

    /**
     * @Given a game has begun
     */
    public function aGameHasBegun()
    {
        $this->gameIdentity = GameId::createNew();
        $this->scenario->given([
            new GameBegan($this->gameIdentity)
        ]);
    }

    /**
     * @When I (try to) play the :square square as the :player player
     */
    public function iPlayTheMiddleSquareAsThePlayer(Square $square, Player $player)
    {
        try {
            $this->scenario->when(
                new TakeMove($this->gameIdentity, $square, $player)
            );
        }
        catch (MoveNotValid $e) {
            $this->exception = $e;
        }
    }

    /**
     * @Then the :square square should have been played with an :player
     */
    public function theSquareShouldHaveBeenPlayedWithAn(Square $square, Player $player)
    {
        $this->scenario->then([
            new MoveTaken($this->gameIdentity, $square, $player)
        ]);
    }

    /**
     * @Given I have played the :square square as the :player player
     */
    public function iHavePlayedTheMiddleSquareAsThePlayer(Square $square, Player $player)
    {
        $this->scenario->given([
            new MoveTaken($this->gameIdentity, $square, $player)
        ]);
    }

    /**
     * @Then I should not have been allowed to play that move
     */
    public function iShouldNotHaveBeenAllowedToPlayThatMove()
    {
        if (!$this->exception instanceof MoveNotValid) {
            throw new \RuntimeException('Move was allowed when it was not supposed to be');
        }
    }

    /**
     * @Then the :square square should not have been played by the :player player
     */
    public function theCentreTopSquareShouldNotHaveBeenPlayed(Square $square, Player $player)
    {
        $this->scenario->thenNot(
            new MoveTaken($this->gameIdentity, $square, $player)
        );
    }

    /**
     * @Transform :square
     */
    public function transformSquare($string)
    {
        if ('middle' == $string) {
            return Square::atPosition("B", 2);
        }
        elseif ('centre-top' == $string) {
            return Square::atPosition("A", 2);
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
