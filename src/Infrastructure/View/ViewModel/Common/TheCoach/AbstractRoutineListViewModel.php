<?php

namespace App\Infrastructure\View\ViewModel\Common\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

abstract class AbstractRoutineListViewModel implements ViewModelInterface
{
    public int $id;
    public string $title;
    public string $added;
}