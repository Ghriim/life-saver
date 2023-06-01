<?php

namespace App\Infrastructure\Repository\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookAuthorDTO;
use App\Domain\Gateway\Provider\TheLibrarian\BookAuthorDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

final class BookAuthorRepository extends ServiceEntityRepository implements BookAuthorDTOProviderGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookAuthorDTO::class);
    }

    public function getAuthorByOpenLibraryKey(string $openLibraryKey): ?BookAuthorDTO
    {
        return $this->createQueryBuilder('author')
                    ->andWhere('author.openLibraryKey = :openLibraryKey')
                    ->setParameter('openLibraryKey', $openLibraryKey)
                    ->getQuery()
                    ->getOneOrNullResult();
    }
}