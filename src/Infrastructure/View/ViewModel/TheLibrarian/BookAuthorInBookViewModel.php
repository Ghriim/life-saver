<?php

namespace App\Infrastructure\View\ViewModel\TheLibrarian;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class BookAuthorInBookViewModel implements ViewModelInterface
{
    public int $id;

    public string $fullName;
}