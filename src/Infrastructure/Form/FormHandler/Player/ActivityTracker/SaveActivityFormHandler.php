<?php

namespace App\Infrastructure\Form\FormHandler\Player\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityDTO;
use App\Domain\Gateway\Provider\ActivityTracker\ActivityDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Player\ActivityTracker\SaveActivityFormType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveActivityFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private ActivityDTOProviderGateway $providerGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $activity = $this->provideDTO($request);
        $form = $this->formFactory->create(
            SaveActivityFormType::class,
            $activity
        );
        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $activity);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): ActivityDTO
    {
        if (false === $request->attributes->has('activityId')) {
            return new ActivityDTO();
        }

        $activity = $this->providerGateway->getActivityById($request->attributes->get('activityId'));
        if (null === $activity) {
            throw new NotFoundHttpException();
        }

        return $activity;
    }
}