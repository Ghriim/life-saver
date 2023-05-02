<?php

namespace App\Infrastructure\Controller\Player;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

abstract class AbstractPlayerController extends AbstractController
{
    public function getCurrentUserId(): int
    {
        return 1;
    }
}