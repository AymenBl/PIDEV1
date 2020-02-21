<?php

namespace chasseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class saisonRechType extends AbstractType

{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('animal',EntityType::class, array(
            'class'=>'chasseBundle:annimal',
        'choice_label'=>'nomAnnimal',
        'multiple'=>false))


            ->add('lieu',EntityType::class, array(
                'class'=>'chasseBundle:lieu',
                'choice_label'=>'nom',
                'multiple'=>false
            ))

            ->add('Recherch',SubmitType::class);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'chasseBundle\Entity\saison'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'chassebundle_saison';
    }


}
