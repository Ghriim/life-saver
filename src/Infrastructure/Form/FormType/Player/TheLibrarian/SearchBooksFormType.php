<?php

namespace App\Infrastructure\Form\FormType\Player\TheLibrarian;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

final class SearchBooksFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add(
                    'isbn',
                    TextType::class,
                    [
                        'required' => false
                    ]
                )
                ->add(
                    'title',
                    TextType::class,
                    [
                        'required' => false
                    ]
                )
                ->add(
                    'author',
                    TextType::class,
                    [
                        'required' => false
                    ]
                );
    }
}