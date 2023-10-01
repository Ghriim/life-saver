<?php

namespace App\Domain\DTO\User;

use App\Domain\DTO\AbstractBaseDTO;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class UserDTO extends AbstractBaseDTO implements  UserInterface, PasswordAuthenticatedUserInterface
{
    public string $email;
    public string $password;
    public array $roles = [];

    public UserSettingsDTO $settings;

    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}
