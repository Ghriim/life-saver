<?php

namespace App\Infrastructure\Controller\Player;

abstract class AbstractPlayerController extends AbstractBaseController
{
    protected function getCurrentUserId(): int
    {
        return $this->getUser()->id;
    }
}
