<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Settings;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AvatarType extends AbstractType
{
    public function __construct(private ContainerBagInterface $container) {}

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('avatar', FileType::class, [
                'required' => true,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Upload avatar'
            ])
        ;

        $builder->get('avatar')
            ->addModelTransformer(new CallbackTransformer(
                fn(string $stringToFile) => new File($this->container->get('kernel.project_dir') . '/public/avatar/' . $stringToFile),
                fn(File $fileToString) => $fileToString->getRealPath()
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
        ]);
    }
}
