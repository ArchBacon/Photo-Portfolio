<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['placeholder' => 'Name'],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a name.']),
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => ['placeholder' => 'Email'],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a valid email address.']),
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a password']),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'invalid_message' => 'The password fields must match.',
                'first_options' => ['label' => false, 'attr' => ['placeholder' => 'Password']],
                'second_options' => ['label' => false, 'attr' => ['placeholder' => 'Repeat Password']],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Register',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
