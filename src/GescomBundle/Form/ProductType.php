<?php

namespace GescomBundle\Form;

use GescomBundle\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',   TextType::class, ['label' => 'Nom de produit'])
            ->add('description', TextareaType::class, [ 'label'     =>  'Insérer une description du produit',
                'attr'      =>  ['rows' => '5', ],
            ])
            //VERY IMPORTANT !!! SF automatically retrieves correct data through doctrine links
            ->add('category')
            // JE NE COMPRENDS PAS - we defined explicitely a FormType as parameter
            ->add('productSuppliers', SupplierListType::class)

            ->add('submit', SubmitType::class, ['label' => 'Enregistrer le produit'])
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        // JE NE COMPRENDS PAS
        $resolver->setDefaults(['data_class' => Product::class,]);
    }

    /**
     * @return string
     */
    public function getBlockPrefix()
    {
        return 'gescom_bundle_product_type';
    }
}
