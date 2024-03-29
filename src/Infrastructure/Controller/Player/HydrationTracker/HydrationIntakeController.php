<?php

namespace App\Infrastructure\Controller\Player\HydrationTracker;

use App\Infrastructure\Controller\Player\AbstractPlayerController;
use App\Infrastructure\Form\FormHandler\Player\HydrationTracker\AddHydrationIntakeFormHandler;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\UseCase\Player\HydrationTracker\AddHydrationIntakeUseCase;
use App\UseCase\Player\HydrationTracker\DeleteHydrationIntakeUseCase;
use DateTimeImmutable;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class HydrationIntakeController extends AbstractPlayerController
{
    #[Route('/me/hydration-tracker/summaries/today/intakes/add', name: 'page_player_hydration_intake_add_for_today', requirements: ['intakeId' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/me/hydration-tracker/summaries/{date}/intakes/add', name: 'page_player_hydration_intake_add_for_date', requirements: ['intakeId' => '\d+'], methods: ['GET', 'POST'])]
    public function addHydrationIntake(
        ?string $date,
        Request $request,
        AddHydrationIntakeFormHandler $formHandler,
        AddHydrationIntakeUseCase $useCase
    ): Response {
        $date = $date ?? DateTimeViewFormatter::toStringFormat(new DateTimeImmutable(), true);

        $formHandler = $formHandler->handle($request);
        if (true === $formHandler->isHandledSuccessfully()) {
            $useCase->execute(
                $formHandler->getDto(),
                $date,
                $this->getCurrentUserId()
            );

            return $this->redirectTo($request,  'page_player_current_user_hydration_summary_for_date', ['date' => $date]);
        }

        return $this->render('player/hydration-tracker/pages/intake-add.html.twig', ['form' => $formHandler->getForm()->createView(), 'date' => $date]);
    }

    #[Route('/me/hydration-tracker/summaries/today/intakes/{intakeId}/delete', name: 'page_player_hydration_intake_delete_for_today', requirements: ['intakeId' => '\d+'], methods: ['POST'])]
    #[Route('/me/hydration-tracker/summaries/{date}/intakes/{intakeId}/delete', name: 'page_player_hydration_intake_delete_for_date', requirements: ['intakeId' => '\d+'], methods: ['POST'])]
    public function deleteHydrationIntake(
        ?string $date,
        int $intakeId,
        Request $request,
        DeleteHydrationIntakeUseCase $useCase): Response
    {
        $date = $date ?? DateTimeViewFormatter::toStringFormat(new DateTimeImmutable(), true);

        $useCase->execute($this->getCurrentUserId(), $intakeId);

        return $this->redirectTo(
            $request,
            'page_player_current_user_hydration_summary_for_date',
            ['date' => $date]
        );
    }
}