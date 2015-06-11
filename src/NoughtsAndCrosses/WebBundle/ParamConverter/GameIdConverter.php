<?php

namespace NoughtsAndCrosses\WebBundle\ParamConverter;

use NoughtsAndCrosses\Core\GameId;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

class GameIdConverter implements ParamConverterInterface
{
    public function apply(Request $request, ParamConverter $configuration)
    {
        if ($request->attributes->has('id')) {
            $request->attributes->set(
                $configuration->getName(),
                GameId::fromUrlToken($request->attributes->get('id'))
            );

            return true;
        }
    }

    public function supports(ParamConverter $configuration)
    {
        return $configuration->getClass() === GameId::class;
    }
}
