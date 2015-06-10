<?php

namespace NoughtsAndCrosses\WebBundle\Controller;

use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\Command\CommandBus;
use NoughtsAndCrosses\Core\GameId;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route(service="webbundle.gamecontroller")
 */
class GameController extends Controller
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
     * @Route("/")
     * @Method("GET")
     *
     * @Template
     */
    public function listAction()
    {
        return [];
    }

    /**
     * @Route("/")
     * @Method("POST")
     */
    public function createGameAction()
    {
        $this->commandBus->dispatch(
            new BeginGame($id = GameId::createNew())
        );

        return new RedirectResponse($this->urlGenerator->generate('game', ['id' => $id->asUrlToken()]));
    }

    /**
     * @Route("/game/{id}", requirements={"id"="[0-9a-zA-Z-_]+"}, name="game")
     * @Method("GET")
     *
     * @Template
     */
    public function gameAction()
    {
        return [];
    }
}
