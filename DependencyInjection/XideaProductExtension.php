<?php

namespace Xidea\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;

use Xidea\Bundle\BaseBundle\DependencyInjection\AbstractExtension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaProductExtension extends AbstractExtension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        list($config, $loader) = $this->setUp($configs, new Configuration($this->getAlias()), $container);

        $loader->load('product.yml');
        $loader->load('product_orm.yml');
        $loader->load('manufacturer.yml');
        $loader->load('manufacturer_orm.yml');
        $loader->load('user.yml');
        $loader->load('controller.yml');
        $loader->load('form.yml');

        $this->loadProductSection($config['product'], $container, $loader);
        $this->loadManufacturerSection($config['manufacturer'], $container, $loader);
    }
    
    protected function loadProductSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.product.class', $config['class']);
        $container->setAlias('xidea_product.product.configuration', $config['configuration']);
        $container->setAlias('xidea_product.product.factory', $config['factory']);
        $container->setAlias('xidea_product.product.builder', $config['builder']);
        $container->setAlias('xidea_product.product.director', $config['director']);
        $container->setAlias('xidea_product.product.manager', $config['manager']);
        $container->setAlias('xidea_product.product.loader', $config['loader']);
        $container->setAlias('xidea_product.user.provider', $config['user_provider']);
        
        if (!empty($config['form'])) {
            $this->loadProductFormSection($config['form'], $container, $loader);
        }
        
        if(isset($config['template'])) {
            $this->loadTemplateSection(sprintf('%s.%s', $this->getAlias(), 'product'), $config['template'], $container, $loader);
        }
    }
    
    protected function loadProductFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_product.product.form.create.factory', $config['create']['factory']);
        $container->setAlias('xidea_product.product.form.create.handler', $config['create']['handler']);
        
        $container->setParameter('xidea_product.product.form.create.type', $config['create']['type']);
        $container->setParameter('xidea_product.product.form.create.name', $config['create']['name']);
        $container->setParameter('xidea_product.product.form.create.validation_groups', $config['create']['validation_groups']);
    }
    
    protected function loadManufacturerSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.manufacturer.class', $config['class']);
        $container->setAlias('xidea_product.manufacturer.configuration', $config['configuration']);
        $container->setAlias('xidea_product.manufacturer.factory', $config['factory']);
        $container->setAlias('xidea_product.manufacturer.loader', $config['manager']);
        $container->setAlias('xidea_product.manufacturer.manager', $config['manager']);
        
        if(isset($config['template'])) {
            $this->loadTemplateSection(sprintf('%s.%s', $this->getAlias(), 'manufacturer'), $config['template'], $container, $loader);
        }
    }
    
    protected function getConfigurationDirectory()
    {
        return __DIR__.'/../Resources/config';
    }
}
