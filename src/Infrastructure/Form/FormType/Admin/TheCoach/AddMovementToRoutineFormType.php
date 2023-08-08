<?php

namespace App\Infrastructure\Form\FormType\Admin\TheCoach;

use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\DTO\TheCoach\RoutineToMovementDTO;
use App\Infrastructure\Repository\TheCoach\MovementDTORepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AddMovementToRoutineFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                    'movement',
                    EntityType::class,
                    [
                        'class' => MovementDTO::class,
                        'choice_label' => 'name',
                        'required' => true,
                        'query_builder' => function (MovementDTORepository $repository) {
                            return $repository->createQueryBuilder('movement')
                                              ->orderBy('movement.name', 'ASC');
                        },
                    ]
                )
                ->add(
                    'targetReps',
                    IntegerType::class,
                    [
                        'required' => false,
                        'attr' => ['min' => 1, 'max' => 1000]
                    ]
                )
                ->add(
                    'targetWeight',
                    IntegerType::class,
                    [
                        'required' => false,
                        'attr' => ['min' => 1]
                    ]
                )
                ->add(
                    'targetDuration',
                    IntegerType::class,
                    [
                        'required' => false,
                        'attr' => ['min' => 1]
                    ]
                )
                ->add(
                    'targetDistance',
                    IntegerType::class,
                    [
                        'required' => false,
                        'attr' => ['min' => 1]
                    ]
                )
                ->add(
                    'targetRest',
                    IntegerType::class,
                    [
                        'required' => false,
                        'attr' => ['min' => 1]
                    ]
                )
                ->add(
                    'generateWarmup',
                    CheckboxType::class,
                    [
                        'required' => false,
                    ]
                );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => RoutineToMovementDTO::class]);
    }
}