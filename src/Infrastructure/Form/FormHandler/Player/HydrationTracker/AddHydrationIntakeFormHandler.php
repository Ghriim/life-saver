<?php

namespace App\Infrastructure\Form\FormHandler\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationIntakeDTO;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Player\HydrationTracker\AddHydrationIntakeFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

final class AddHydrationIntakeFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $intake = new HydrationIntakeDTO();
        $form = $this->formFactory->create(
            AddHydrationIntakeFormType::class,
            $intake
        );
        $form->handleRequest($request);

        $formWrapper = new FormWrapper($intake, $form);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }
}
