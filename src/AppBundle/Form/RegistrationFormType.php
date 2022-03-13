<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 10/02/2019
 * Time: 11:48
 */

namespace AppBundle\Form;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseRegistrationFormType;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFormType extends AbstractType

{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName',HiddenType::class)
                ->add('lastName',HiddenType::class)
                ->add('city',HiddenType::class)
                ->add('phone',HiddenType::class)
               ->add('dateOfBirth',HiddenType::class);
    }

    public function getParent()
    {
        return BaseRegistrationFormType::class;

    }


}