<?php

namespace App\Form;

use App\Entity\Book;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ISBN', null, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Le champ ISBN ne doit pas être vide.',
                    ]),
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le champ ISBN ne doit pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('Titre')
            ->add('Resumer')
            ->add('Description')
            ->add('Prix', null, [
                'constraints' => [
                    new GreaterThan([
                        'value' => 0,
                        'message' => 'Le prix doit être supérieur à 0.',
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
