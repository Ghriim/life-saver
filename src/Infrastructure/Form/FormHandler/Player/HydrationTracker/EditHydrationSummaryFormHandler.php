<?php

namespace App\Infrastructure\Form\FormHandler\Player\HydrationTracker;

use App\Domain\DTO\HydrationTracker\HydrationSummaryDTO;
use App\Domain\Gateway\Provider\HydrationTracker\HydrationSummaryDTOProviderGateway;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormType\Player\HydrationTracker\EditHydrationSummaryFormType;
use DateTimeImmutable;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class EditHydrationSummaryFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private HydrationSummaryDTOProviderGateway $providerGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $summary = $this->provideDTO($request);
        $form = $this->formFactory->create(
            EditHydrationSummaryFormType::class,
            $summary
        );
        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $summary);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): HydrationSummaryDTO
    {
        try {
            $date = new DateTimeImmutable($request->attributes->get('date'));
        } catch (Exception) {
            throw new NotFoundHttpException();
        }

        if ($date > new DateTimeImmutable()) {
            throw new NotFoundHttpException();
        }

        $summary = $this->providerGateway->getHydrationSummaryByUserIdAndDate(
            $request->attributes->get('userId'),
            $date
        );

        if (null === $summary) {
            throw new NotFoundHttpException();
        }

        return $summary;
    }
}
