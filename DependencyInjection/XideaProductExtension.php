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
        $loader->load('member.yml');
        $loader->load('controller.yml');
        $loader->load('handler.yml');
        $loader->load('form.yml');

        $container->setParameter('xidea_product.product.class', $config['product_class']);
        $container->setAlias('xidea_product.product_factory', $config['product_factory']);
        $container->setAlias('xidea_product.product_builder', $config['product_builder']);
        $container->setAlias('xidea_product.product_director', $config['product_director']);
        $container->setAlias('xidea_product.product_manager', $config['product_manager']);
        $container->setAlias('xidea_product.product_loader', $config['product_loader']);
        $container->setAlias('xidea_product.member_provider', $config['member_provider']);
        $container->setAlias('xidea_product.route_handler', $config['route_handler']);
        $container->setAlias('xidea_product.view_handler', $config['view_handler']);
        
        if (!empty($config['product_create'])) {
            $this->loadCreate($config['product_create'], $container, $loader);
        }
        
        $this->loadTemplate($config, $container, $loader);
    }
    
    private function loadCreate(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.create.form.type', $config['create_form']['type']);
        $container->setParameter('xidea_product.create.form.name', $config['create_form']['name']);
        $container->setParameter('xidea_product.create.form.validation_groups', $config['create_form']['validation_groups']);
    }
    
    private function loadTemplate(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $layouts = array();
        foreach ($config['layouts'] as $name => $parameters) {
            $layouts[$name] = $parameters;
        }
        $container->setParameter('xidea_product.layouts', $layouts);
        
        $templates = array();
        foreach ($config['templates'] as $name => $parameters) {
            $templates[$name] = $parameters;
        }
        $container->setParameter('xidea_product.templates', $templates);
    }
}
