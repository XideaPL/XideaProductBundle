<?php

namespace Xidea\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface,
    Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('xidea_product');

        $this->addProductSection($rootNode);

        return $treeBuilder;
    }
    
    private function addProductSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('product')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('factory')->defaultValue('xidea_product.product_factory.default')->end()
                        ->scalarNode('builder')->defaultValue('xidea_product.product_builder.default')->end()
                        ->scalarNode('director')->defaultValue('xidea_product.product_director.default')->end()
                        ->scalarNode('manager')->defaultValue('xidea_product.product_manager.default')->end()
                        ->scalarNode('loader')->defaultValue('xidea_product.product_loader.default')->end()
                        ->scalarNode('user_provider')->defaultValue('xidea_product.user_provider.default')->end()
                        ->arrayNode('create')
                            ->addDefaultsIfNotSet()
                            ->canBeUnset()
                            ->children()
                                ->arrayNode('form')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('type')->defaultValue('xidea_product_create')->end()
                                        ->scalarNode('name')->defaultValue('xidea_product_create_form')->end()
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
}
