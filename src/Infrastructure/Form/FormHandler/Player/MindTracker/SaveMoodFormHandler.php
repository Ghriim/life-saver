<?php

namespace App\Infrastructure\Form\FormHandler\Player\MindTracker;

use App\Domain\DTO\MindTracker\MoodDTO;
use App\Domain\Gateway\Provider\MindTracker\MoodDTOProviderGateway;
use App\Infrastructure\Form\FormType\Player\MindTracker\SaveMoodFormType;
use App\Infrastructure\Form\FormHandler\FormWrapper;
use App\Infrastructure\Form\FormHandler\FormHandlerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SaveMoodFormHandler implements FormHandlerInterface
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private MoodDTOProviderGateway $providerGateway,
    ) {

    }

    public function handle(Request $request, ?string $context = null): FormWrapper
    {
        $mood = $this->provideDTO($request);
        $form = $this->formFactory->create(
            SaveMoodFormType::class,
            $mood
        );
        $form->handleRequest($request);

        $formWrapper = new FormWrapper($form, $mood);
        if ($form->isSubmitted() && $form->isValid()) {
            $formWrapper->setIsHandledSuccessfully(true);
        }

        return $formWrapper;
    }

    private function provideDTO(Request $request): MoodDTO
    {
        if (false === $request->attributes->has('moodId')) {
            return new MoodDTO();
        }

        $mood = $this->providerGateway->getMoodById($request->attributes->get('moodId'));
        if (null === $mood) {
            throw new NotFoundHttpException();
        }

        return $mood;
    }
}