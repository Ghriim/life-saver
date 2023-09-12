<?php

namespace App\Infrastructure\View\ViewModel\Common\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

abstract class AbstractMovementListViewModel implements ViewModelInterface
{
    public int $id;
    public string $name;
    public string $image;
    public string $added;
}