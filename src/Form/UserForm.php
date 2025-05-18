<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 bg-gray-800 text-white rounded',
                    'placeholder' => 'Entrez votre email',
                ],
            ])
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 bg-gray-800 text-white rounded',
                    'placeholder' => 'Entrez votre pseudo',
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Utilisateur' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                    'Banni' => 'ROLE_BANNED',
                ],
                'expanded' => true,
                'multiple' => true,
                'label' => 'Rôles',
                'attr' => [
                    'class' => 'space-y-2',
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 bg-gray-800 text-white rounded',
                    'placeholder' => 'Entrez votre prénom',
                ],
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'w-full p-2 bg-gray-800 text-white rounded',
                    'placeholder' => 'Entrez votre nom',
                ],
            ])
            ->add('profilePicture', TextType::class, [
                'required' => false,
                'attr' => [
                    'class' => 'w-full p-2 bg-gray-800 text-white rounded',
                    'placeholder' => 'URL de la photo de profil (optionnel)',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
