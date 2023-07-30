<?php

namespace App\Infrastructure\Form\FormType\Player\ActivityTracker;

use App\Domain\DTO\ActivityTracker\ActivityTypeDTO;
use App\Infrastructure\Repository\ActivityTracker\ActivityTypeDTORepository;
use App\Infrastructure\Repository\ActivityTracker\BookRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SaveActivityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                    'title',
                    TextType::class,
                    [
                        'required' => false,
                    ]
                )->add(
                    'activityType',
                    EntityType::class,
                    [
                        'class' => ActivityTypeDTO::class,
                        'choice_label' => 'title',
                        'required' => false,
                        'query_builder' => function (ActivityTypeDTORepository $repository) {
                            return $repository->createQueryBuilder('type')
                                      ->orderBy('type.title', 'ASC');
                        },
                        'group_by' => function (ActivityTypeDTO $activityType) {
                            return $activityType->activityCategory->title;
                        },
                    ]
                );
    }
}
