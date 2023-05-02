<?php

namespace App\Infrastructure\Persister;

use App\Domain\DTO\DTOInterface;
use DateTimeImmutable;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

abstract class AbstractPersister implements PersisterInterface
{
    public function __construct(protected ManagerRegistry $doctrine)
    {
    }

    abstract protected function getEntityClassName(): string;

    public function remove(DTOInterface $dto, bool $flush = true): void
    {
        $this->getManager()->remove($dto);
        if (true === $flush) {
            $this->flush();
        }
    }

    public function save(DTOInterface $dto, bool $flush = true): DTOInterface
    {
        if (null === $dto->id) {
            $dto->createDate = new DateTimeImmutable();
        }
        $dto->updateDate = new DateTimeImmutable();
        
        $this->getManager()->persist($dto);
        if (true === $flush) {
            $this->flush();
        }

        return $dto;
    }

    protected function flush(): void
    {
        $this->getManager()->flush();
    }

    protected function getManager(): EntityManager|ObjectManager
    {
        return $this->doctrine->getManagerForClass($this->getEntityClassName());
    }

    protected function getRepository(): EntityRepository|ObjectRepository
    {
        return $this->doctrine->getRepository($this->getEntityClassName());
    }
}
