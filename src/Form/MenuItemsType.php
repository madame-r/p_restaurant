<?php

namespace App\Form;

use App\Entity\MenuCategories;
use App\Entity\MenuItems;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Vich\UploaderBundle\Form\Type\VichFileType;


class MenuItemsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('stock_quantity')

            ->add('imageFile', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_uri' => false,
                'label' => 'Menu Item Image',
            ])

            ->add('created_at', null, [
                'widget' => 'single_text',
            ])
            ->add('menuCategories', EntityType::class, [
                'class' => MenuCategories::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MenuItems::class,
        ]);
    }
}
