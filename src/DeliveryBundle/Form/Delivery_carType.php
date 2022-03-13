<?php
/**
 * Created by PhpStorm.
 * User: ASUS
 * Date: 17/02/2019
 * Time: 01:31
 */

namespace DeliveryBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;


class Delivery_carType extends AbstractType
{

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {


        $builder->add('Matricule', TextType::class)
            ->add('Type', TextType::class)
            ->add('Status', TextType::class)

            ->add('add', SubmitType::class);
    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            // 'data_class' => 'ReservationBundle\Entity\Reservation'
            'data_class' => 'DeliveryBundle\Entity\Delivery_car'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        //  return 'reservationbundle_reservation';
        return 'deliverybundle_delivery';
    }

}

