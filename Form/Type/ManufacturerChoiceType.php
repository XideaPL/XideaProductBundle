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
use Xidea\Bundle\BaseBundle\Form\DataTransformer\ModelToIdTransformer;
use Xidea\Product\Manufacturer\LoaderInterface;

/**
 * Description of RegistrationType
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ManufacturerChoiceType extends AbstractType
{
    /*
     * var LoaderInterface
     */
    protected $loader;

    /**
     * @param LoaderInterface $loader The Manufacturer loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new ModelToIdTransformer($this->loader);
        $builder->addModelTransformer($transformer, true);
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'choices' => $this->getChoices()
        ));
    }
    
    public function getParent()
    {
        return 'choice';
    }

    public function getName()
    {
        return 'xidea_manufacturer_choice';
    }
    
    protected function getChoices()
    {
        $result = array();
        
        $manufacturers = $this->loader->loadAll();

        foreach($manufacturers as $manufacturer) {
            $result[$manufacturer->getId()] = $manufacturer->getName();
        }
        
        return $result;
    }
}
