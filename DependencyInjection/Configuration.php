<?php

namespace Xidea\Bundle\ProductBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder,
    Symfony\Component\Config\Definition\ConfigurationInterface,
    Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;

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
        
        $this->addConfigurationSection($rootNode);
        $this->addProductSection($rootNode);
        $this->addTemplateSection($rootNode);

        return $treeBuilder;
    }
    
    public function getDefaultTemplateNamespace()
    {
        return 'XideaProductBundle';
    }
    
    public function getDefaultTemplates()
    {
        return array(
            'list' => array(
                'path' => 'Product\List:list'
            ),
            'show' => array(
                'path' => 'Product\Show:show'
            ),
            'create' => array(
                'path' => 'Product\Create:create'
            ),
            'create_form' => array(
                'path' => 'Product\Create:create_form'
            )
        );
    }
    
    protected function addProductSection(ArrayNodeDefinition $node)
    {
        $node
            ->children()
                ->arrayNode('product')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('class')->isRequired()->cannotBeEmpty()->end()
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
                                ->arrayNode('create')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('factory')->defaultValue('xidea_product.product.form.create.factory.default')->end()
                                        ->scalarNode('handler')->defaultValue('xidea_product.product.form.create.handler.default')->end()
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
