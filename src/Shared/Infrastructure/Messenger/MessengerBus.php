<?php

namespace App\Shared\Infrastructure\Messenger;

use App\Shared\Domain\Buses\AsyncInterface;
use App\Shared\Domain\Buses\CommandInterface;
use App\Shared\Domain\Buses\CommandResponseInterface;
use App\Shared\Domain\Buses\QueryInterface;
use App\Shared\Domain\Buses\QueryResponseInterface;
use Symfony\Component\Messenger\Exception\ExceptionInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;

class MessengerBus
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus,
        private readonly MessageBusInterface $asyncBus,
    ) {
    }

    /**
     * @throws ExceptionInterface
     */
    public function dispatchCommand(CommandInterface $command): CommandResponseInterface
    {
        $dispatch = $this->commandBus->dispatch($command);

        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $result = $dispatch->last(HandledStamp::class)?->getResult();

        if (!$result instanceof CommandResponseInterface) {
            throw new \RuntimeException('Command handler must return a CommandResponseInterface');
        }

        return $result;
    }

    /**
     * @throws ExceptionInterface
     */
    public function dispatchQuery(QueryInterface $query): QueryResponseInterface
    {
        $dispatch = $this->queryBus->dispatch($query);

        /** @noinspection PhpPossiblePolymorphicInvocationInspection */
        $result = $dispatch->last(HandledStamp::class)?->getResult();

        if (!$result instanceof QueryResponseInterface) {
            throw new \RuntimeException('Query handler must return a QueryResponseInterface');
        }

        return $result;
    }

    /**
     * @throws ExceptionInterface
     */
    public function dispatchAsync(AsyncInterface $async): void
    {
        $this->asyncBus->dispatch($async);
    }
}