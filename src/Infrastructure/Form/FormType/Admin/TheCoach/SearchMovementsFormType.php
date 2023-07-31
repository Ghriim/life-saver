<?php

namespace App\Infrastructure\Form\FormType\Admin\TheCoach;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SearchMovementsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                    'name',
                    TextType::class,
                    [
                        'required' => false
                    ]
                );
    }
}
