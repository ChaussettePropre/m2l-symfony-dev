<?php

namespace App\Form;

use App\Entity\Bureau;
use App\Entity\Association;
use App\Entity\Ligue;
use phpDocumentor\Reflection\Types\Null_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;



class BureauType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $ligues = $options['ligues'];
        $builder
            ->add('occupant', ChoiceType::class, array(
                'required' => false,
                'choices' => $ligues,
                'choice_label' => function(?Ligue $entity) {
                    return $entity ? $entity->getNom() : '';
            }))
            ->add('attribuer', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bureau::class,
            'ligues'=> false,
        ]);
    }
}