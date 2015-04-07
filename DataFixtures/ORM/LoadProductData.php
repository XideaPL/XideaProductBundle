<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class LoadProductData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $data = $this->loadData();

        $productManager = $this->container->get('xidea_product.product.manager');
        
        foreach($data as $product) {
            $productManager->save($product);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
    
    /**
     * Returns a product factory.
     * 
     * @return \Xidea\Bundle\ProductBundle\Model\ProductFactory The product factory
     */
    protected function getProductFactory()
    {
        return $this->container->get('xidea_product.product.factory');
    }
    
    /**
     * Returns a data.
     * 
     * @return array The data
     */
    protected function loadData()
    {
        $productFactory = $this->getProductFactory();
        
        $product1 = $productFactory->create();
        $product1->setSku('SKU1');
        $product1->setName('Product 1');
        $product1->setDescription('Product 1 description');
        $product1->setManufacturer($this->getReference('manufacturer-acme'));
        
        $product2 = $productFactory->create();
        $product2->setSku('SKU2');
        $product2->setName('Product 2');
        $product2->setDescription('Product 2 description');
        $product2->setManufacturer($this->getReference('manufacturer-shield'));
        
        return array(
            $product1,
            $product2
        );
    }
 
}
