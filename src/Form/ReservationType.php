<?php

namespace App\Form;


use App\Entity\Bureau;
use App\Entity\Reservation;
use App\Entity\Salle;
use App\Entity\Sallereservable;
use PhpParser\Node\Expr\Array_;
use Symfony\Component\PropertyAccess\PropertyPath;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $salles= $options['salles'];

        if($salles[0] instanceof Sallereservable){
            $builder
            ->add('salle', ChoiceType::class, array(
                'choices' => $salles,
                'choice_label' =>function(?Salle $entity) {
                    return $entity ? $entity->getNom() : '';
                }))
            ->add('association')
            ->add('datedebut')
            ->add('datefin')
            ->add('reserver', SubmitType::class);
        }
        else{
        $builder
            ->add('association')
            ->add('datedebut')
            ->add('reserver', SubmitType::class);
        };
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'salles'=>false,
        ]);
    }
}