<?php

namespace App\Infrastructure\Form\FormHandler\Player\BodyTracker;

use App\Domain\DTO\BodyTracker\SleepDTO;
use App\Domain\Gateway\Provider\BodyTracker\SleepDTOProviderGateway;
use App\Infrastructure\Form\FormType\Player\BodyTracker\AddSleepFormType;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use DateTimeImmutable;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveSleepFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private SleepDTOProviderGateway $providerGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $sleep = $this->provideDTO($request);
        $form = $this->formFactory->create(
            AddSleepFormType::class,
            $sleep
        );
        $form->handleRequest($request);

        $formWrapper = new FormWrapper($sleep, $form);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): SleepDTO
    {
        if (false === $request->attributes->has('sleepId')) {
            $sleep = new SleepDTO();
            $sleep->inBed = new DateTimeImmutable();

            return $sleep;
        }

        $sleep = $this->providerGateway->getSleepById($request->attributes->get('sleepId'));
        if (null === $sleep) {
            throw new NotFoundHttpException();
        }

        return $sleep;
    }
}