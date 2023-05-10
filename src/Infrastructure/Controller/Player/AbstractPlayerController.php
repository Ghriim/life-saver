<?php

namespace App\Infrastructure\Controller\Player;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

abstract class AbstractPlayerController extends AbstractController
{
    protected function getCurrentUserId(): int
    {
        return 1;
    }

    protected function redirectTo(Request $request, string $routeName, array $parameters = []): RedirectResponse
    {
        $redirect = $request->query->get('redirect');
        if (null === $redirect) {
            return $this->redirectToRoute($routeName, ['date' => $parameters]);
        }

        return $this->redirectToRoute($redirect);
    }
}