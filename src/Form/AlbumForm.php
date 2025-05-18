<?php

namespace App\Form;

use App\Entity\Album;
use App\Entity\Artist;
use App\Entity\Playlist;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AlbumForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', null, [
                'label' => 'Titre de l\'album',
                'attr' => [
                    'class' => 'form-input bg-gray-800 text-white rounded-lg p-2',
                    'placeholder' => 'Entrez le titre de l\'album',
                ],
            ])
            ->add('artist', EntityType::class, [
                'class' => Artist::class,
                'choice_label' => 'name',
                'label' => 'Artiste',
                'attr' => [
                    'class' => 'form-select bg-gray-800 text-white rounded-lg p-2',
                ],
            ])
            ->add('playlists', EntityType::class, [
                'class' => Playlist::class,
                'choice_label' => 'name',
                'multiple' => true,
                'label' => 'Playlists associées',
                'attr' => [
                    'class' => 'form-multiselect bg-gray-800 text-white rounded-lg p-2',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Album::class,
        ]);
    }
}
