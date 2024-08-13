<?php

namespace App\Tests\GameOperations\Application\AddNewGame;

use App\GameOperations\Application\AddNewGame\AddNewGameCommand;
use App\GameOperations\Application\AddNewGame\AddNewGameHandler;
use App\GameOperations\Domain\Game\Game;
use App\GameOperations\Domain\Game\GameId;
use App\GameOperations\Domain\Game\GameRepositoryInterface;
use PHPUnit\Framework\TestCase;

class AddNewGameHandlerTest extends TestCase
{
    public function testAddNewGame(): void
    {
        // Arrange
        $command = new AddNewGameCommand(
            'Cyberpunk 2077',
            'The best game ever',
            59.99,
            'USD',
            'PC'
        );

        $gameId = new GameId('01J56DG1CKQ5BG09T49ZWQXX4V');
        $gameRepository = $this->createMock(GameRepositoryInterface::class);
        $gameRepository
            ->method('nextIdentity')
            ->willReturn($gameId);

        $gameRepository
            ->expects($this->once())
            ->method('save')
            ->with($this->callback(function (Game $game) use ($gameId) {
                return $game->getPrice()->amount === 59_99;
            }));

        $handler = new AddNewGameHandler($gameRepository);

        // Act
        $response = $handler($command);

        // Assert
        $this->assertEquals(['id' => '01J56DG1CKQ5BG09T49ZWQXX4V'], $response->toArray());
    }
}