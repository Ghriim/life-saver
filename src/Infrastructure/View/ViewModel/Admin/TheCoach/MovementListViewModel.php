<?php

namespace App\Infrastructure\View\ViewModel\Admin\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class MovementListViewModel implements ViewModelInterface
{
    public int $id;
    public string $name;
    public string $image;
    public string $added;
}