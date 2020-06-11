<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Projet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ProjetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom')
            ->add('nomEntreprise')
            ->add('contenu')
            ->add('pictureFile', FileType::class,[
                'label'=>'insérer une image',
                'mapped'=>false])
            ->add('extrait')
            ->add('competence', EntityType::class, [ // relié à l'entity compétences
                'class' => Competence::class,
                'label' => 'Compétences',
                'multiple' => true, // choix multiple
                'expanded' => true, // permet d'avoir une liste de case à cocher
            ]);
    }


    public
    function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Projet::class,
        ]);
    }
}
