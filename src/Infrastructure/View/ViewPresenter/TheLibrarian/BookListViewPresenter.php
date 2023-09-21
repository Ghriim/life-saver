<?php

namespace App\Infrastructure\View\ViewPresenter\TheLibrarian;

use App\Domain\DTO\TheLibrarian\BookDTO;
use App\Infrastructure\View\ViewModel\TheLibrarian\BookListViewModel;
use App\Infrastructure\View\ViewPresenter\ViewPresenterInterface;

final class BookListViewPresenter implements ViewPresenterInterface
{
    use PresentAuthorInBookViewTrait;

    /**
     * @param BookDTO[] $DTOs
     */
    public function present(array $DTOs): array
    {
        $models = [];
        foreach ($DTOs as $DTO) {
            $model = new BookListViewModel();
            $model->id = $DTO->id;
            $model->title = $DTO->title;
            $model->authors = $this->presentAuthors($DTO);

            $models[] = $model;
        }

        return $models;
    }
}