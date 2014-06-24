<?php

namespace Xidea\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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

        $rootNode
            ->children()
                ->scalarNode('product_class')->isRequired()->cannotBeEmpty()->end()
                ->scalarNode('product_factory')->defaultValue('xidea_product.product_factory.default')->end()
                ->scalarNode('product_builder')->defaultValue('xidea_product.product_builder.default')->end()
                ->scalarNode('product_director')->defaultValue('xidea_product.product_director.default')->end()
                ->scalarNode('product_manager')->defaultValue('xidea_product.product_manager.default')->end()
                ->scalarNode('product_loader')->defaultValue('xidea_product.product_loader.default')->end()
                ->scalarNode('member_provider')->defaultValue('xidea_product.member_provider.default')->end()
                ->scalarNode('route_handler')->defaultValue('xidea_product.route_handler.default')->end()
                ->scalarNode('view_handler')->defaultValue('xidea_product.view_handler.default')->end()
            ->end()
        ;

        $this->addCreateSection($rootNode);
        $this->addTemplateSection($rootNode);

        return $treeBuilder;
    }
    
    private function addCreateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('product_create')
                    ->addDefaultsIfNotSet()
                    ->canBeUnset()
                    ->children()
                        ->arrayNode('create_form')
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
            ->end();
    }
    
    private function addTemplateSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('layouts')
                    ->useAttributeAsKey('name')
                    ->prototype('scalar')->end()
                    ->defaultValue(array())
                ->end()
                ->arrayNode('templates')
                    ->useAttributeAsKey('name')
                    ->prototype('array')->end()
                    ->defaultValue(array())
                ->end()
            ->end();
    }
}
