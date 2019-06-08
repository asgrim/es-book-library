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
            throw new \DomainException('don\'t have that book you ass');
        }
        $this->recordThat(new BookWasCheckedOut());
    }

    public function checkIn()
    {
        if ($this->onShelf) {
            throw new \DomainException('we already have that, go away you filthy human');
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
