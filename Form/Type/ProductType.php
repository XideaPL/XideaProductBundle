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
            ->add('slug', null, array(
                'label' => 'product.slug'
            ))
            ->add('name', null, array(
                'label' => 'product.name'
            ))
            ->add('description', null, array(
                'label' => 'product.description'
            ))
            ->add('shortDescription', null, array(
                'label' => 'product.short_description'
            ))
            ->add('url', null, array(
                'label' => 'product.url'
            ))
            ->add('price', null, array(
                'label' => 'product.price'
            ))
            ->add('retailPrice', null, array(
                'label' => 'product.retail_price'
            ))
            ->add('qty', null, array(
                'label' => 'product.qty'
            ))
            ->add('width', null, array(
                'label' => 'product.width'
            ))
            ->add('height', null, array(
                'label' => 'product.height'
            ))
            ->add('depth', null, array(
                'label' => 'product.depth'
            ))
            ->add('availableOn', 'date', array(
                'label' => 'product.available_on',
                'widget' => 'single_text'
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
