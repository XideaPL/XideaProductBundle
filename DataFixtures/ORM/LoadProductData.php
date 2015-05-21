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
        $product1->setSlug('product-1');
        $product1->setName('Product 1');
        $product1->setDescription('Product 1 description');
        $product1->setShortDescription('Product 1 short description');
        $product1->setUrl('product-1.html');
        $product1->setPrice(39.90);
        $product1->setRetailPrice(29.90);
        $product1->setQty(10);
        $product1->setWidth(10);
        $product1->setHeight(10);
        $product1->setDepth(10);
        $product1->setAvailableOn(new \DateTime());
        $product1->setManufacturer($this->getReference('manufacturer-acme'));
        
        $product2 = $productFactory->create();
        $product2->setSku('SKU2');
        $product2->setSlug('product-2');
        $product2->setName('Product 2');
        $product2->setDescription('Product 2 description');
        $product2->setShortDescription('Product 2 short description');
        $product2->setUrl('product-2.html');
        $product2->setPrice(39.90);
        $product2->setRetailPrice(29.90);
        $product2->setQty(20);
        $product2->setWidth(20);
        $product2->setHeight(20);
        $product2->setDepth(20);
        $product2->setAvailableOn(new \DateTime());
        $product2->setManufacturer($this->getReference('manufacturer-shield'));
        
        return array(
            $product1,
            $product2
        );
    }
 
}
