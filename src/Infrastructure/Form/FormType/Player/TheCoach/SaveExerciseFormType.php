<?php

namespace App\Infrastructure\Form\FormType\Player\TheCoach;

use App\Domain\DTO\TheCoach\ExerciseDTO;
use App\Domain\DTO\TheCoach\MovementDTO;
use App\Domain\Registry\TheCoach\ExerciseSetTypeRegistry;
use App\Domain\Registry\TheCoach\WorkoutStatusRegistry;
use App\Infrastructure\Repository\TheCoach\MovementDTORepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SaveExerciseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        /** @var ExerciseDTO $exercise */
        $exercise = $builder->getData();

        $builder->add(
            'movement',
            EntityType::class,
            [
                'class' => MovementDTO::class,
                'choice_label' => 'name',
                'required' => true,
                'disabled' => null !== $exercise->id,
                'query_builder' => function (MovementDTORepository $repository) {
                    return $repository->createQueryBuilder('movement')
                                      ->orderBy('movement.name', 'ASC');
                },
            ]
        );

        if (true === in_array($exercise->workout->status, WorkoutStatusRegistry::TARGET_DATA_EDITABLE)) {
            $builder->add(
                'targetReps',
                IntegerType::class,
                ['required' => false]
            )->add(
                'targetWeight',
                IntegerType::class,
                ['required' => false]
            )->add(
                'targetDuration',
                IntegerType::class,
                ['required' => false]
            )->add(
                'targetDistance',
                IntegerType::class,
                ['required' => false]
            );
        }

        if (true === in_array($exercise->workout->status, WorkoutStatusRegistry::COMPLETED_DATA_EDITABLE)) {
            $builder->add(
                'completedReps',
                IntegerType::class,
                ['required' => false]
            )->add(
                'completedWeight',
                IntegerType::class,
                ['required' => false]
            )->add(
                'completedDuration',
                IntegerType::class,
                ['required' => false]
            )->add(
                'completedDistance',
                IntegerType::class,
                ['required' => false]
            );
        }

        $builder->add(
            'restDuration',
            IntegerType::class,
            ['required' => false]
        )->add(
            'setType',
            ChoiceType::class,
            [
                'required' => true,
                'choices' => [
                    ExerciseSetTypeRegistry::SET_TYPE_WORK => ExerciseSetTypeRegistry::SET_TYPE_WORK,
                    ExerciseSetTypeRegistry::SET_TYPE_WARMUP => ExerciseSetTypeRegistry::SET_TYPE_WARMUP,
                    ExerciseSetTypeRegistry::SET_TYPE_DROP => ExerciseSetTypeRegistry::SET_TYPE_DROP,
                    ExerciseSetTypeRegistry::SET_TYPE_FAILED => ExerciseSetTypeRegistry::SET_TYPE_FAILED,
                ],
                'data' => ExerciseSetTypeRegistry::SET_TYPE_WORK,
            ]
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => ExerciseDTO::class]);
    }
}