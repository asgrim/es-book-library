<?php

declare(strict_types=1);

namespace Asgrim;

use EventSauce\EventSourcing\Serialization\SerializablePayload;

final class BookWasCheckedOut implements SerializablePayload
{
    public function toPayload() : array
    {
        return [];
    }

    public static function fromPayload(array $payload) : SerializablePayload
    {
        return new self();
    }
}
