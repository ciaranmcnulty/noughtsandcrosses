<?php

namespace NoughtsAndCrosses\WebBundle\Controller;

use NoughtsAndCrosses\Core\Infrastructure\CommandBus;
use NoughtsAndCrosses\Core\GameId;
use NoughtsAndCrosses\Core\Player;
use NoughtsAndCrosses\Core\Square;
use NoughtsAndCrosses\Core\TakeMove;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route(service="web_bundle.game_play_controller")
 */
class GamePlayController
{
    /**
     * @var CommandBus
     */
    private $commandBus;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator, CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @Route("/game/{id}", requirements={"id"="[0-9a-zA-Z-_]+"}, name="game")
     * @Method("GET")
     *
     * @Template
     */
    public function showAction()
    {
        return [];
    }

    /**
     * @Route("/game/{id}", requirements={"id"="[0-9a-zA-Z-_]+"}, name="play")
     * @Method("POST")
     *
     * @Template
     */
    public function playAction(Request $request, GameId $id)
    {
        $square = $this->getSquareFromRequest($request);
        $player = $request->request->get('player') == 'X' ? Player::X() : Player::O();

        $this->commandBus->dispatch(
            new TakeMove($id, $square, $player)
        );

        return new RedirectResponse($this->urlGenerator->generate('game', ['id' => $id->asUrlToken()]));
    }

    private function getSquareFromRequest(Request $request)
    {
        if ($request->request->has('square-middle')) {
            return Square::atPosition('B', 2);
        }

        throw new \InvalidArgumentException('Unknown square');
    }
}
