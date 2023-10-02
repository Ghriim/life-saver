<?php

namespace App\Infrastructure\Controller\Public;

use App\Domain\DTO\User\UserDTO;
use App\Domain\DTO\User\UserSettingsDTO;
use App\Infrastructure\Controller\Player\AbstractBaseController;
use App\Infrastructure\Form\FormHandler\Public\UserRegistrationByEmailFormHandler;
use App\Infrastructure\Form\FormType\Public\RegistrationFormType;
use App\UseCase\Player\User\UserRegistrationByEmailUseCase;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractBaseController
{
    #[Route('/register', name: 'page_register_by_email')]
    public function registerByEmail(
        Request $request,
        UserRegistrationByEmailFormHandler $formHandler,
        UserRegistrationByEmailUseCase $useCase,
    ): Response  {
        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute($formHandler->getDto(), $formHandler->getForm()->get('plainPassword')->getData());

            return $this->redirectTo($request,'page_player_dashboard');
        }

        return $this->render(
            'public/registration/pages/register-by-email.html.twig',
            [
                'form' => $formHandler->getForm()->createView()
            ]
        );
    }
}
