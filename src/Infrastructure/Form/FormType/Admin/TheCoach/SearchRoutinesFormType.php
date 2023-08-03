<?php

namespace App\Infrastructure\Form\FormType\Admin\TheCoach;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SearchRoutinesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                    'title',
                    TextType::class,
                    [
                        'required' => false
                    ]
                );
    }
}
