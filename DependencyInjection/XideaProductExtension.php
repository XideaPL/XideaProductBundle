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

        $this->loadProductSection($config['product'], $container, $loader);
        $this->loadManufacturerSection($config['manufacturer'], $container, $loader);

        $this->loadTemplateSection($config, $container, $loader);
    }

    protected function loadProductSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.product.code', $config['code']);
        $container->setParameter('xidea_product.product.class', $config['class']);
        $container->setAlias('xidea_product.product.configuration', $config['configuration']);
        $container->setAlias('xidea_product.product.factory', $config['factory']);
        $container->setAlias('xidea_product.product.builder', $config['builder']);
        $container->setAlias('xidea_product.product.director', $config['director']);
        $container->setAlias('xidea_product.product.manager', $config['manager']);
        $container->setAlias('xidea_product.product.loader', $config['loader']);

        if (!empty($config['form'])) {
            $this->loadProductFormSection($config['form'], $container, $loader);
        }
    }

    protected function loadProductFormSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setAlias('xidea_product.product.form.factory', $config['product']['factory']);
        $container->setAlias('xidea_product.product.form.handler', $config['product']['handler']);

        $container->setParameter('xidea_product.product.form.type.name', $config['product']['type']);
        $container->setParameter('xidea_product.product.form.name', $config['product']['name']);
        $container->setParameter('xidea_product.product.form.validation_groups', $config['product']['validation_groups']);
    }

    protected function loadManufacturerSection(array $config, ContainerBuilder $container, Loader\YamlFileLoader $loader)
    {
        $container->setParameter('xidea_product.manufacturer.code', $config['code']);
        $container->setParameter('xidea_product.manufacturer.class', $config['class']);
        $container->setAlias('xidea_product.manufacturer.configuration', $config['configuration']);
        $container->setAlias('xidea_product.manufacturer.factory', $config['factory']);
        $container->setAlias('xidea_product.manufacturer.loader', $config['loader']);
        $container->setAlias('xidea_product.manufacturer.manager', $config['manager']);
    }

    protected function getConfigurationDirectory()
    {
        return __DIR__ . '/../Resources/config';
    }

    protected function getDefaultTemplates()
    {
        return [
            'product_main' => ['path' => '@XideaProduct/main'],
            'product_list' => ['path' => '@XideaProduct/Product/List/list'],
            'product_show' => ['path' => '@XideaProduct/Product/Show/show'],
            'product_create' => ['path' => '@XideaProduct/Product/Create/create'],
            'product_form' => ['path' => '@XideaProduct/Product/Form/form'],
            'product_form_fields' => ['path' => '@XideaProduct/Product/Form/fields']
        ];
    }

}
