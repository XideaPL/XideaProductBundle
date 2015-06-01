<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of RegistrationType
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductType extends AbstractType
{
    /*
     * var string
     */
    protected $class;

    /**
     * @param string $class The Product class name
     */
    public function __construct($class)
    {
        $this->class = $class;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sku', null, array(
                'label' => 'product.sku'
            ))
            ->add('name', null, array(
                'label' => 'product.name'
            ))
            ->add('slug', null, array(
                'label' => 'product.slug',
                'required' => false
            ))
            ->add('description', null, array(
                'label' => 'product.description',
                'required' => false
            ))
            ->add('shortDescription', null, array(
                'label' => 'product.short_description',
                'required' => false
            ))
            ->add('url', null, array(
                'label' => 'product.url',
                'required' => false
            ))
            ->add('price', null, array(
                'label' => 'product.price',
                'required' => false
            ))
            ->add('retailPrice', null, array(
                'label' => 'product.retail_price',
                'required' => false
            ))
            ->add('qty', null, array(
                'label' => 'product.qty',
                'required' => false
            ))
            ->add('image', null, array(
                'label' => 'product.image',
                'required' => false
            ))
            ->add('imageLabel', null, array(
                'label' => 'product.image_label',
                'required' => false
            ))
            ->add('width', null, array(
                'label' => 'product.width',
                'required' => false
            ))
            ->add('height', null, array(
                'label' => 'product.height',
                'required' => false
            ))
            ->add('depth', null, array(
                'label' => 'product.depth',
                'required' => false
            ))
            ->add('availableOn', 'date', array(
                'label' => 'product.available_on',
                'widget' => 'single_text',
                'required' => false
            ))
            ->add('save', 'submit', array('label' => 'product_form.submit'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => $this->class
        ));
    }

    public function getName()
    {
        return 'xidea_product';
    }

}
