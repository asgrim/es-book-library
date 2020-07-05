<?php /** @noinspection ContractViolationInspection */

declare(strict_types=1);

namespace Asgrim;

use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviourWithRequiredHistory;

final class Book implements AggregateRoot
{
    use AggregateRootBehaviourWithRequiredHistory;

    private bool $onShelf = false;

    public static function newBookWithId(BookId $bookId): self
    {
        $book = new self($bookId);
        $book->checkIn();
        return $book;
    }

    public function checkOut(): void
    {
        if (!$this->onShelf) {
            throw new \DomainException('That book is not currently available, please pick another.');
        }
        $this->recordThat(new BookWasCheckedOut());
    }

    public function checkIn(): void
    {
        if ($this->onShelf) {
            throw new \DomainException('This book is already checked in.');
        }
        $this->recordThat(new BookWasCheckedIn());
    }

    private function applyBookWasCheckedOut(): void
    {
        echo "checked out\n";
        $this->onShelf = false;
    }

    private function applyBookWasCheckedIn(): void
    {
        echo "checked in\n";
        $this->onShelf = true;
    }
}
