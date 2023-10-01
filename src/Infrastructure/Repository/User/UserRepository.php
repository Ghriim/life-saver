<?php

namespace App\Infrastructure\Repository\User;

use App\Domain\DTO\User\UserDTO;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserRepository extends ServiceEntityRepository implements UserDTOProviderGateway, UserProviderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UserDTO::class);
    }

    public function getUserById(int $userId): ?UserDTO
    {
        return $this->createQueryBuilder('user')
                    ->leftJoin('user.settings', 'user_settings')
                    ->addSelect('user_settings')
                    ->andWhere('user.id = :userId')
                    ->setParameter('userId', $userId)
                    ->getQuery()->getOneOrNullResult();
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        return $this->createQueryBuilder('user')
                    ->leftJoin('user.settings', 'user_settings')
                    ->addSelect('user_settings')
                    ->andWhere('user.id = :userId')
                    ->setParameter('userId', $user->id)
                    ->getQuery()->getOneOrNullResult();
    }

    public function supportsClass(string $class)
    {
        // TODO: Implement supportsClass() method.
    }

    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        // TODO: Implement loadUserByIdentifier() method.
    }
}
