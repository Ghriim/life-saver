<?php

namespace App\Infrastructure\View\ViewModel\Admin\TheCoach;

use App\Infrastructure\View\ViewModel\ViewModelInterface;

final class MovementDetailsViewModel implements ViewModelInterface
{
    public int $id;
    public string $name;
    public string $image;
    public string $added;

    /** @var EquipmentListViewModel[] */
    public array $equipments;
}