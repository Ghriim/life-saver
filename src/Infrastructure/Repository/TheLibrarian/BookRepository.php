<?php

namespace App\Infrastructure\Repository\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Domain\Gateway\Provider\TheLibrarian\BookDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

final class BookRepository extends ServiceEntityRepository implements BookDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookDTO::class);
    }

    private function buildQueryBuilder(): QueryBuilder
    {
        return  $this->createQueryBuilder('book')
                     ->leftJoin('book.authors', 'author')
                     ->addSelect('author');
    }

    public function getBookByISBN(string $isbn): ?BookDTO
    {
        return  $this->buildQueryBuilder()
                      ->andWhere('book.isbn13 = :isbn')
                      ->setParameter('isbn', $isbn)
                      ->getQuery()
                      ->getOneOrNullResult();
    }

    public function getBookByIdAndUserId(int $bookId, int $userId): ?BookDTO
    {
        return  $this->buildQueryBuilder()
                     ->leftJoin('book.bookOfUsers', 'book_user', Expr\Join::WITH,'book_user.userId = :userId')
                     ->setParameter('userId', $userId)
                     ->andWhere('book.id = :bookId')
                     ->setParameter('bookId', $bookId)
                     ->getQuery()
                     ->getOneOrNullResult();
    }

    public function getBooks(?int $authorId = null, ?string $title = null): array
    {
        $queryBuilder = $this->buildQueryBuilder()
                             ->addOrderBy('book.title');

        if (null !== $authorId) {
            $queryBuilder->andWhere('author.id = :authorId')
                         ->setParameter('authorId', $authorId);
        }

        if (null !== $title) {
            $queryBuilder->andWhere('book.title LIKE :title')
                         ->setParameter('title', '%'.$title.'%');
        }

        return $queryBuilder->getQuery()->getResult();
    }
}