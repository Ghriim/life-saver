<?php

namespace App\Infrastructure\Form\FormHandler\Player\BodyTracker;

use App\Domain\DTO\BodyTracker\WeightDTO;
use App\Domain\Gateway\Provider\BodyTracker\WeightDTOProviderGateway;
use App\Infrastructure\Form\FormType\Player\BodyTracker\AddWeightFormType;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use DateTimeImmutable;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveWeightFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private WeightDTOProviderGateway $providerGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $weight = $this->provideDTO($request);
        $form = $this->formFactory->create(
            AddWeightFormType::class,
            $weight
        );
        $form->handleRequest($request);

        $formWrapper = new FormWrapper($weight, $form);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): WeightDTO
    {
        if (false === $request->attributes->has('weightId')) {
            $weight = new WeightDTO();
            $weight->inBed = new DateTimeImmutable();

            return $weight;
        }

        $weight = $this->providerGateway->getWeightById($request->attributes->get('weightId'));
        if (null === $weight) {
            throw new NotFoundHttpException();
        }

        return $weight;
    }
}