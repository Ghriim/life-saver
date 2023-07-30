<?php

namespace App\Infrastructure\Controller\Player;

abstract class AbstractAdminController extends AbstractBaseController
{
    protected function getCurrentAdminId(): int
    {
        return 1;
    }
}