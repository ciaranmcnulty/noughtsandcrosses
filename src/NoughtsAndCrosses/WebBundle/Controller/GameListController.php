<?php

namespace NoughtsAndCrosses\WebBundle\Controller;

use NoughtsAndCrosses\Core\BeginGame;
use NoughtsAndCrosses\Core\Infrastructure\CommandBus;
use NoughtsAndCrosses\Core\GameId;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * @Route(service="web_bundle.game_list_controller")
 */
class GameListController
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
}
