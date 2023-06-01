<?php

namespace App\Infrastructure\View\ViewPresenter\Player\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Infrastructure\View\ViewModel\Player\TheLibrarian\BookAuthorInBookViewModel;

trait PresentAuthorInBookViewTrait
{
    /**
     * @return BookAuthorInBookViewModel[]
     */
    protected function presentAuthors(BookDTO $DTO): array
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