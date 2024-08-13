<?php

namespace App\GameOperations\Infrastructure\Controller;

use App\GameOperations\Application\AddNewGame\AddNewGameCommand;
use App\Shared\Infrastructure\Messenger\MessengerBus;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AddNewGameController extends AbstractController
{
    public function __construct(private readonly MessengerBus $bus)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = new AddNewGameCommand(
            $request->get('name'),
            $request->get('description'),
            (float) $request->get('price'),
            $request->get('currency'),
            $request->get('platform'),
        );

        $response = $this->bus->dispatchCommand($command);

        return new JsonResponse($response->toArray(), Response::HTTP_CREATED);
    }
}