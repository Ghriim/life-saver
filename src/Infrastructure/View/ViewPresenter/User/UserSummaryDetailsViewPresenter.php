<?php

namespace App\Infrastructure\View\ViewPresenter\User;

use App\Domain\DTO\User\UserSummaryDTO;
use App\Infrastructure\View\ViewModel\User\UserSummaryDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class UserSummaryDetailsViewPresenter implements ViewPresenterInterface
{
    public function present(UserSummaryDTO $DTO): UserSummaryDetailsViewModel
    {
        return new UserSummaryDetailsViewModel();
    }
}