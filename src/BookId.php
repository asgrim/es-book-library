<?php

declare(strict_types=1);

namespace Asgrim;

use Assert\Assert;
use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class BookId implements AggregateRootId
{
    private UuidInterface $id;

    private function __construct(UuidInterface $id)
    {
        $this->id = $id;
    }

    public static function new() : self
    {
        return new self(Uuid::uuid4());
    }

    public static function fromString(string $aggregateRootId) : AggregateRootId
    {
        Assert::that($aggregateRootId)->uuid();
        return new self(Uuid::fromString($aggregateRootId));
    }

    /** @return string */
    public function toString() : string
    {
        return $this->id->toString();
    }
}
