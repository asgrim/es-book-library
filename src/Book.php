<?php

declare(strict_types=1);

namespace Asgrim;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class Book implements AggregateRoot
{
    use AggregateRootBehaviour;

    private $onShelf = true;

    public function checkOut()
    {
        $this->recordThat(new BookWasCheckedOut());
    }

    public function checkIn()
    {
        $this->recordThat(new BookWasCheckedIn());
    }

    private function applyBookWasCheckedOut()
    {
        $this->onShelf = false;
    }

    private function applyBookWasCheckedIn()
    {
        $this->onShelf = true;
    }
}
