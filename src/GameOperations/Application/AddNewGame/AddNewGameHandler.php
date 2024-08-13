<?php

namespace App\GameOperations\Application\AddNewGame;

use App\GameOperations\Domain\Game\Game;
use App\GameOperations\Domain\Game\GameId;
use App\GameOperations\Domain\Game\GamePlatform;
use App\GameOperations\Domain\Game\GamePrice;
use App\GameOperations\Domain\Game\GameRepositoryInterface;
use App\Shared\Domain\Buses\CommandHandlerInterface;
use DateTimeImmutable;

class AddNewGameHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly GameRepositoryInterface $gameRepository,
    ) {
    }

    public function __invoke(AddNewGameCommand $command): AddNewGameResponse
    {
        $game = new Game(
            id: $this->gameRepository->nextIdentity(),
            name: $command->name,
            description: $command->description,
            price: GamePrice::create($command->price, $command->currency),
            platform: GamePlatform::from($command->platform),
            createdAt: new DateTimeImmutable(),
            updatedAt: new DateTimeImmutable(),
        );

        $this->gameRepository->save($game);

        return new AddNewGameResponse($game->getId());
    }
}