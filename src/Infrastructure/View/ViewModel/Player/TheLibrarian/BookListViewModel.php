<?php

namespace App\Infrastructure\View\ViewModel\Player\TheLibrarian;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class BookListViewModel implements ViewModelInterface
{
    public int $id;

    public string $title;

    /**
     * @var BookAuthorInBookViewModel[]
     */
    public array $authors;
}