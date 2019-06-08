<?php

declare(strict_types=1);

namespace Asgrim;

use EventSauce\EventSourcing\Serialization\SerializableEvent;

final class BookWasCheckedIn implements SerializableEvent
{
    public function toPayload() : array
    {
        return [];
    }

    public static function fromPayload(array $payload) : SerializableEvent
    {
        return new self();
    }
}
