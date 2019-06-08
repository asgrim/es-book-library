<?php

declare(strict_types=1);

namespace Asgrim;

use Assert\Assert;
use EventSauce\EventSourcing\AggregateRootId;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class BookId implements AggregateRootId
{
    /** @var UuidInterface */
    private $id;

    private function __construct()
    {
    }

    public static function fromString(string $aggregateRootId) : AggregateRootId
    {
        Assert::that($aggregateRootId)->uuid();

        $instance = new self();
        $instance->id = Uuid::fromString($aggregateRootId);
        return $instance;
    }

    /** @return string */
    public function toString() : string
    {
        return $this->id->toString();
    }
}
