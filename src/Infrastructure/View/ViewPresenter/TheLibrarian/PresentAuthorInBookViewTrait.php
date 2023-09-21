<?php

namespace App\Infrastructure\View\ViewPresenter\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Infrastructure\View\ViewModel\TheLibrarian\BookAuthorInBookViewModel;

trait PresentAuthorInBookViewTrait
{
    /**
     * @return BookAuthorInBookViewModel[]
     */
    PUBLIC function presentAuthors(BookDTO $DTO): array
    {
        $authors = [];
        foreach ($DTO->getAuthors() as $author) {
            $authorModel = new BookAuthorInBookViewModel();
            $authorModel->id = $author->id;
            $authorModel->fullName = $author->fullName;

            $authors[]= $authorModel;
        }

        return $authors;
    }
}