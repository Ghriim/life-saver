<?php

namespace App\Infrastructure\Controller\Player;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractBaseController extends AbstractController
{
    protected function redirectTo(Request $request, string $defaultRouteName, array $parameters = []): RedirectResponse
    {
        $redirect = $request->query->get('redirect', $defaultRouteName);

        return $this->redirectToRoute($redirect, $parameters);
    }
}