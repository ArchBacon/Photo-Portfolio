<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Settings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileType extends AbstractType
{
    public function __construct() {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'ex. John Doe'],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter your name.']),
                ],
            ])
            ->add('occupation', TextType::class, [
                'attr' => ['placeholder' => 'ex. Photographer'],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter an occupation.']),
                ],
            ])
            ->add('introduction', TextareaType::class, [
                'attr' => ['placeholder' => 'About me'],
                'constraints' => [
                    new NotBlank(['message' => 'Say something about yourself.']),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Save',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
        ]);
    }
}
