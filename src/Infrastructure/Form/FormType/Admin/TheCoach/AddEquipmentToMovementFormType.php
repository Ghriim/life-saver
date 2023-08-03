<?php

namespace App\Infrastructure\Form\FormType\Admin\TheCoach;

use App\Domain\DTO\TheCoach\EquipmentDTO;
use App\Domain\Gateway\Provider\TheCoach\EquipmentDTOProviderGateway;
use App\Infrastructure\Repository\TheCoach\EquipmentDTORepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

final class AddEquipmentToMovementFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
            'equipment',
            EntityType::class,
            [
                'class' => EquipmentDTO::class,
                'choice_label' => 'name',
                'required' => false,
                'query_builder' => function (EquipmentDTORepository $repository) {
                    return $repository->createQueryBuilder('equipment')
                                      ->orderBy('equipment.name', 'ASC');
                },
            ]
        );
    }
}