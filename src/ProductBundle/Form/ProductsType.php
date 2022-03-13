<?php

namespace ProductBundle\Form;

use KleeGroup\GoogleReCaptchaBundle\Form\Type\ReCaptchaType;
use ReCaptcha\ReCaptcha;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class ProductsType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sku',null,['label' => 'Product reference'])
            ->add('price',IntegerType::class,['label' => 'Product price'])
            ->add('date',DateType::class)

            ->add('name',null,['label' => 'Product name'])
            ->add('shortdesc',TextareaType::class,['label' => 'Product short description'])
            ->add('longdesc',TextareaType::class,['label' => 'Product long description'])
            ->add('image',FileType::class,array('data_class' => null),['label' => 'Product image'])
            ->add('stock', null,['label' => 'Product stock'])

        ->add('status',ChoiceType::class, [ 'label' => 'Product status',

                'choices'  => [
                    'Published' => 'Published',
                    'Draft' => 'Draft',
                ],
            ])
            ->add('category' ,EntityType::class,
            array(
                'label' => 'Category name',
                'class' =>'ProductBundle:Categories',
                'choice_label' => 'CategoryName',
                'multiple' =>false,

            ))
            ->add('solde',EntityType::class,
                array(
                    'label' => 'Discount',
                    'class' =>'MarketingBundle:Promotion',
                    'choice_label' => 'discount',
                    'multiple' =>false
                ))->
        add('Submit',SubmitType::class,['label' => 'Save'])
            ->add('recaptcha', ReCaptchaType::class,
                [
                    'mapped'      => false,
                    'constraints' => [
                        new \KleeGroup\GoogleReCaptchaBundle\Validator\Constraints\ReCaptcha(),
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ProductBundle\Entity\Products'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'productbundle_products';
    }


}
