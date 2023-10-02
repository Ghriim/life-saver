<?php

namespace App\Infrastructure\Form\FormHandler\Public;

use App\Domain\DTO\User\UserDTO;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Public\RegistrationFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class UserRegistrationByEmailFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
    ) {
    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $user = new UserDTO();
        $form = $this->formFactory->create(
            RegistrationFormType::class,
            $user,
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $user);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }
}