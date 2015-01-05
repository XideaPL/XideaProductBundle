<?php

namespace Xidea\Bundle\ProductBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle,
    Symfony\Component\DependencyInjection\ContainerBuilder;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;

class XideaProductBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $this->addRegisterMappingsPass($container);
    }

    /**
     * @param ContainerBuilder $container
     */
    private function addRegisterMappingsPass(ContainerBuilder $container)
    {
        $mappings = array(
            realpath(__DIR__ . '/Resources/config/doctrine/model') => 'Xidea\Component\Product\Model',
        );
        
        if(in_array($container->getParameter('kernel.environment'), array('test'))) {
        }
        
        $container->addCompilerPass(DoctrineOrmMappingsPass::createYamlMappingDriver($mappings));
    }
}
