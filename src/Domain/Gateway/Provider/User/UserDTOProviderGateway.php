<?php

namespace App\Domain\Gateway\Provider\User;

use App\Domain\DTO\User\UserDTO;

interface UserDTOProviderGateway
{
    public function getUserById(int $userId): ?UserDTO;
}