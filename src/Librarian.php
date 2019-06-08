<?php

declare(strict_types=1);

namespace Asgrim;

use EventSauce\EventSourcing\Message;
use EventSauce\EventSourcing\MessageDispatcher;

final class Librarian implements MessageDispatcher
{
    public function dispatch(Message ...$messages): void
    {
        echo 'uhh';
    }
}
