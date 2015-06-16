<?php

namespace Xidea\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

use Xidea\Bundle\BaseBundle\DependencyInjection\AbstractConfiguration;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration extends AbstractConfiguration
{
    public function __construct($alias)
    {
        parent::__construct($alias);
    }
    
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = parent::getConfigTreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);
        
        $this->addProductSection($rootNode);
        $this->addManufacturerSection($rootNode);
        $this->addTemplateSection($rootNode);

        return $treeBuilder;
    }
    
    public function getDefaultTemplateNamespace()
    {
        return '@XideaProduct';
    }
    
    protected function addProductSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('product')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('code')->defaultValue('xidea_product')->end()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_product.product.factory.default')->end()
                        ->scalarNode('builder')->defaultValue('xidea_product.product.builder.default')->end()
                        ->scalarNode('director')->defaultValue('xidea_product.product.director.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_product.product.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_product.product.loader.default')->end()
                        ->scalarNode('user_provider')->defaultValue('xidea_product.user.provider.default')->end()
                        ->arrayNode('form')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('product')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_product.product.form.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_product.product.form.handler.default')->end()
                                        ->scalarNode('type')->defaultValue('xidea_product')->end()
                                        ->scalarNode('name')->defaultValue('product')->end()
                                        ->arrayNode('validation_groups')
                                            ->prototype('scalar')->end()
                                            ->defaultValue(array())
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
    
    protected function addManufacturerSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('manufacturer')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('code')->defaultValue('xidea_product_manufacturer')->end()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('configuration')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_product.manufacturer.factory.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_product.manufacturer.manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_product.manufacturer.loader.default')->end()
                    ->end()
                ->end()
            ->end();
    }
    
    protected function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->append($this->addTemplateNode($this->getDefaultTemplateNamespace(), $this->getDefaultTemplateEngine(), [], true))
            ->end();
    }
}
