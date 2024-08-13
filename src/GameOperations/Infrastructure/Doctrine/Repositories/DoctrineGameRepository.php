<?php

namespace App\GameOperations\Infrastructure\Doctrine\Repositories;

use App\GameOperations\Domain\Game\Game;
use App\GameOperations\Domain\Game\GameId;
use App\GameOperations\Domain\Game\GameNotFoundException;
use App\GameOperations\Domain\Game\GamePlatform;
use App\GameOperations\Domain\Game\GamePrice;
use App\GameOperations\Domain\Game\GameRepositoryInterface;
use App\GameOperations\Infrastructure\Doctrine\Entities\Game as GameDoctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GameDoctrine|null find($id, $lockMode = null, $lockVersion = null)
 * @method GameDoctrine|null findOneBy(array $criteria, array $orderBy = null)
 * @method GameDoctrine[]    findAll()
 * @method GameDoctrine[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DoctrineGameRepository extends ServiceEntityRepository implements GameRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GameDoctrine::class);
    }

    public function get(GameId $gameId): Game
    {
        $gameDoctrine = $this->find($gameId->value);

        if (null === $gameDoctrine) {
            throw new GameNotFoundException($gameId->value);
        }

        return new Game(
            new GameId($gameDoctrine->getId()),
            $gameDoctrine->getName(),
            $gameDoctrine->getDescription(),
            new GamePrice($gameDoctrine->getPrice(), $gameDoctrine->getCurrency()),
            $gameDoctrine->getPlatform(),
            $gameDoctrine->getCreatedAt(),
            $gameDoctrine->getUpdatedAt()
        );
    }

    public function save(Game $game): void
    {
        $gameDoctrine = new GameDoctrine(
            $game->getId()->value,
            $game->getName(),
            $game->getDescription(),
            $game->getPrice()->amount,
            $game->getPrice()->currency,
            $game->getPlatform(),
            $game->getCreatedAt(),
            $game->getUpdatedAt()
        );

        $this->_em->persist($gameDoctrine);
        $this->_em->flush();
    }

    public function nextIdentity(): GameId
    {
        return new GameId(uniqid());
    }
}