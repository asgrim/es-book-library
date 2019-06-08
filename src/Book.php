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
        if (!$this->onShelf) {
            throw new \DomainException('That book is not currently available, please pick another.');
        }
        $this->recordThat(new BookWasCheckedOut());
    }

    public function checkIn()
    {
        if ($this->onShelf) {
            throw new \DomainException('This book is already checked in.');
        }
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
