<?php

namespace App\UseCase\Player\User;

use App\Domain\DTO\User\UserSummaryDTO;
use App\Domain\Gateway\Persister\User\UserSummaryDTOPersisterGateway;
use App\Domain\Gateway\Provider\User\UserDTOProviderGateway;
use App\Domain\Gateway\Provider\User\UserSummaryDTOProviderGateway;
use App\Infrastructure\View\ViewModel\User\UserSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\User\UserSummaryDetailsViewPresenter;
use App\UseCase\UseCaseInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class GetUserSummaryForDateUseCase implements UseCaseInterface
{
    public function __construct(
        private UserSummaryDTOProviderGateway $summaryProviderGateway,
        private UserDTOProviderGateway $userProviderGateway,
        private UserSummaryDTOPersisterGateway $summaryPersister,
        private UserSummaryDetailsViewPresenter $presenter,
    ) {

    }

    public function execute(int $userId, \DateTimeImmutable $date): UserSummaryDetailsViewModel
    {
        $summary = $this->provideSummary($userId, $date);
        if (null === $summary) {
            $user = $this->userProviderGateway->getUserById($userId);
            if (null === $user) {
                throw new NotFoundHttpException();
            }

            $summary = new UserSummaryDTO();
            $summary->user = $user;

            $this->summaryPersister->save($summary);
        }

        return  $this->presenter->present($summary);
    }

    private function provideSummary(int $userId, \DateTimeImmutable $date): ?UserSummaryDTO
    {
        if ($date > new \DateTimeImmutable()) {
            throw new NotFoundHttpException();
        }

        return $this->summaryProviderGateway->getUserSummaryByUserIdAndDate($userId, $date);
    }
}