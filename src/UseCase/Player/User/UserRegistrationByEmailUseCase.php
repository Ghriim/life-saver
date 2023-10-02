<?php

namespace App\UseCase\Player\User;

use App\Domain\DTO\User\UserDTO;
use App\Domain\DTO\User\UserSettingsDTO;
use App\Domain\Gateway\Persister\User\UserDTOPersisterGateway;
use App\UseCase\UseCaseInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserRegistrationByEmailUseCase implements UseCaseInterface
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher,
        private UserDTOPersisterGateway $userDTOPersisterGateway,
    ) {

    }

    public function execute(UserDTO $user, string $plainPassword): void
    {
        $user->password = $this->userPasswordHasher->hashPassword($user, $plainPassword);

        $settings = new UserSettingsDTO();
        $settings->lang = 'fr';
        $settings->weightUnit = 'Kg';
        $settings->distanceUnit = 'Km';
        $settings->createDate = new \DateTimeImmutable();
        $settings->updateDate = new \DateTimeImmutable();

        $user->settings = $settings;

        $this->userDTOPersisterGateway->save($user);
    }
}