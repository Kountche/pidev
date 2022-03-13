<?php

namespace MarketingBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PromotionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('discount',NumberType::class)
                 ->add('dateD',DateTimeType::class,[
                     'placeholder' => [
                         'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                         'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                     ]
                 ])
                 ->add('dateF',DateTimeType::class,[
                     'placeholder' => [
                         'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                         'hour' => 'Hour', 'minute' => 'Minute', 'second' => 'Second',
                     ]
                 ])
                 ->add('modifier',SubmitType::class);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MarketingBundle\Entity\Promotion'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'marketingbundle_promotion';
    }


}
