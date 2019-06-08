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

    $aggregateRootRepository = new ConstructingAggregateRootRepository(
        Book::class,
        new Bookshelf(),
        new Librarian()
    );

    $id = BookId::fromString('ffa930bc-0c62-494c-a29d-1eda3ca0b804');

    /** @var Book $book */
    $book = $aggregateRootRepository->retrieve($id);

    $book->checkOut();
    $book->checkIn();

    $aggregateRootRepository->persist($book);
}
