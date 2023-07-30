<?php

namespace App\Infrastructure\Form\FormHandler\Player\TheLibrarian;

use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Player\TheLibrarian\SearchBooksFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class SearchBooksFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
    ) {
    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $form = $this->formFactory->create(
            SearchBooksFormType::class
        );

        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }
}