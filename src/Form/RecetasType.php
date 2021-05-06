<?php

namespace App\Form;

use App\Entity\Recetas;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RecetasType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('receta')
            ->add('ingredientes', TextareaType::class)
            ->add('preparacion', TextareaType::class)
            ->add('imagen', FileType::class,['label' => 'Seleccione una imagen', 'mapped' => false, 'required' => false])
            ->add('categoria', ChoiceType::class, [
                    'choices' => [
                'Carnes' => 'Carnes',
                'Ensaladas' => 'Ensaladas',
                'Mariscos' => 'Mariscos',
                'Pastas' => 'Pastas',
                'Postres' => 'Postres',
                'Snacks' => 'Snacks',
                'Típicos' => 'Típicos',
                'Otros' => 'Otros',
            ]])
            ->add('Guardar', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recetas::class,
        ]);
    }
}
