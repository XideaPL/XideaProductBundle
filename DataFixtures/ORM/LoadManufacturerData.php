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
class LoadManufacturerData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
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

        $manufacturerManager = $this->container->get('xidea_product.manufacturer.manager');
        
        foreach($data as $manufacturer) {
            $manufacturerManager->save($manufacturer);
        }
    }
    
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
    
    /**
     * Returns a manufacturer factory.
     * 
     * @return \Xidea\Bundle\ProductBundle\Model\ProductFactory The manufacturer factory
     */
    protected function getManufacturerFactory()
    {
        return $this->container->get('xidea_product.manufacturer.factory');
    }
    
    /**
     * Returns a data.
     * 
     * @return array The data
     */
    protected function loadData()
    {
        $manufacturerFactory = $this->getManufacturerFactory();
        
        $manufacturer1 = $manufacturerFactory->create();
        $manufacturer1->setName('Acme');
        $this->setReference('manufacturer-acme', $manufacturer1);
        
        $manufacturer2 = $manufacturerFactory->create();
        $manufacturer2->setName('Shield');
        $this->setReference('manufacturer-shield', $manufacturer2);
        
        return array(
            $manufacturer1,
            $manufacturer2
        );
    }
 
}
