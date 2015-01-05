<?php

namespace Xidea\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class XideaProductExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('product.yml');
        $loader->load('product_orm.yml');
        $loader->load('user.yml');
        $loader->load('controller.yml');
        $loader->load('form.yml');
        
        $this->loadProductSection($config['product'], $container, $loader);
    }
    
    private function loadProductSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.product.class', $config['class']);
        $container->setAlias('xidea_product.product_factory', $config['factory']);
        $container->setAlias('xidea_product.product_builder', $config['builder']);
        $container->setAlias('xidea_product.product_director', $config['director']);
        $container->setAlias('xidea_product.product_manager', $config['manager']);
        $container->setAlias('xidea_product.product_loader', $config['loader']);
        $container->setAlias('xidea_product.user_provider', $config['user_provider']);
        
        if (!empty($config['create'])) {
            $this->loadProductCreateSection($config['create'], $container, $loader);
        }
    }
    
    private function loadProductCreateSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.product_create.form.type', $config['form']['type']);
        $container->setParameter('xidea_product.product_create.form.name', $config['form']['name']);
        $container->setParameter('xidea_product.product_create.form.validation_groups', $config['form']['validation_groups']);
    }
}
