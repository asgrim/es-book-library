<?php

declare(strict_types=1);

namespace Asgrim;

use Assert\Assert;
use EventSauce\EventSourcing\AggregateRootId;
use EventSauce\EventSourcing\Message;
use EventSauce\EventSourcing\MessageRepository;
use Generator;

final class Bookshelf implements MessageRepository
{
    /** @var array<string,array<int,Message>> */
    private $events = [];

    public function persist(Message ...$messages): void
    {
        foreach ($messages as $message) {
            $aggregateRootId = $message->aggregateRootId();

            Assert::that($aggregateRootId)->notNull('Tried to persist a message with no identity.');

            $this->events[$aggregateRootId->toString()][] = $message;
        }
    }

    public function retrieveAll(AggregateRootId $id) : Generator
    {
        yield from $this->events;
    }
}
