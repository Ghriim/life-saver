<?php

namespace App\Infrastructure\Controller\Public;

use App\Domain\DTO\User\UserDTO;
use App\Domain\DTO\User\UserSettingsDTO;
use App\Infrastructure\Controller\Player\AbstractBaseController;
use App\Infrastructure\Form\FormType\Public\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractBaseController
{
    #[Route('/register', name: 'page_register_by_mail')]
    public function registerByEmail(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new UserDTO();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->password = $userPasswordHasher->hashPassword($user,$form->get('plainPassword')->getData());

            $user->createDate = new \DateTimeImmutable();
            $user->updateDate = new \DateTimeImmutable();

            $settings = new UserSettingsDTO();
            $settings->lang = 'fr';
            $settings->weightUnit = 'Kg';
            $settings->distanceUnit = 'Km';
            $settings->createDate = new \DateTimeImmutable();
            $settings->updateDate = new \DateTimeImmutable();

            $user->settings = $settings;

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectTo($request,'page_player_dashboard');
        }

        return $this->render(
            'public/registration/pages/register-by-email.html.twig',
            [
                'registrationForm' => $form->createView()
            ]
        );
    }
}
