<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 10/02/2019
 * Time: 14:51
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType    as BaseProfileFormType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;

class ProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstName',TextType::class,array('required'=>false))
            ->add('lastName',TextType::class,array('required'=>false))
            ->add('city',TextType::class,array('required'=>false))
            ->add('phone',IntegerType::class,array('required'=>false))
            ->add('dateOfBirth',DateType::class,array('required'=>false));
    }


    public function getParent()
    {
        return BaseProfileFormType::class;


    }





}