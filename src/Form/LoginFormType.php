<?php

declare(strict_types=1);

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class LoginFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Email',
                    'autofocus' => true,
                    'value' => $options['last_username'],
                ],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a valid email address.']),
                ]
            ])
            ->add('password', PasswordType::class, [
                'attr' => ['placeholder' => 'Password'],
                'constraints' => [
                    new NotBlank(['message' => 'Please enter a password.']),
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Sign in',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'last_username' => null,
        ]);
    }
}
