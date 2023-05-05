<?php

namespace App\Form;



use App\Entity\Association;
use Symfony\Component\Form\AbstractType;
use App\Entity\Ligue;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class LigueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('nom', TextType::class)
            ->add('adresse', TextType::class)
            ->add('cddepartement', NumberType::class)
            ->add('tel', TelType::class)
            ->add('email', EmailType::class)
            ->add('enregistrer', SubmitType::class);



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }
}
