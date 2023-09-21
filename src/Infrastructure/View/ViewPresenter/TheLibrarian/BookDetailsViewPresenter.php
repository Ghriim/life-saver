<?php

namespace App\Infrastructure\View\ViewPresenter\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Infrastructure\View\ViewFormatter\DateTimeViewFormatter;
use App\Infrastructure\View\ViewModel\TheLibrarian\BookDetailsViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class BookDetailsViewPresenter implements ViewPresenterInterface
{
    use PresentAuthorInBookViewTrait;

    public function present(BookDTO $DTO, int $currentUserId): BookDetailsViewModel
    {
        $model = new BookDetailsViewModel();
        $model->id = $DTO->id;
        $model->title = $DTO->title;
        $model->isbn10 = $DTO->isbn10;
        $model->isbn13 = $DTO->isbn13;
        $model->publishedDate = $DTO->publishedDate ?? 'unknown';
        $model->authors = $this->presentAuthors($DTO);

        $bookOfUser = $DTO->getBookOfUser($currentUserId);
        if (null !== $bookOfUser) {
            $model->isWishlist = $bookOfUser->isWishlist;
            $model->isOwned = $bookOfUser->isOwned;
            $model->isReading = $bookOfUser->isReading;
            $model->isRead = $bookOfUser->isRead;
            $model->isLiked = $bookOfUser->isLiked;
        }


        return $model;
    }
}