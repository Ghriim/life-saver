<?php

namespace App\Infrastructure\View\ViewModel\Player\TheLibrarian;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class BookDetailsViewModel implements ViewModelInterface
{
    public int $id;

    public string $title;

    public string $isbn10;

    public string $isbn13;

    public string $publishedDate;

    /**
     * @var BookAuthorInBookViewModel[]
     */
    public array $authors;
}