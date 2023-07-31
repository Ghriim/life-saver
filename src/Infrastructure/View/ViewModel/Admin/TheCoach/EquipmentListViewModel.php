<?php

namespace App\Infrastructure\View\ViewModel\Admin\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class EquipmentListViewModel implements ViewModelInterface
{
    public int $id;
    public string $name;
    public string $icon;
    public string $added;
}