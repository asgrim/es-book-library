<?php

declare(strict_types=1);

namespace
{
    require __DIR__ . '/vendor/autoload.php';

    use Asgrim\Book;
    use Asgrim\BookId;
    use Asgrim\Bookshelf;
    use Asgrim\Librarian;
    use EventSauce\EventSourcing\ConstructingAggregateRootRepository;
    use EventSauce\EventSourcing\InMemoryMessageRepository;

    $aggregateRootRepository = new ConstructingAggregateRootRepository(
        Book::class,
        new InMemoryMessageRepository(),
        new Librarian()
    );

    $id = BookId::new();

    $book = Book::newBookWithId($id);

    $aggregateRootRepository->persist($book);

    /** @var Book $book */
    $book = $aggregateRootRepository->retrieve($id);

    $book->checkOut();
    $book->checkIn();

    $aggregateRootRepository->persist($book);
}
