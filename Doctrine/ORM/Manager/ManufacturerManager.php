<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Doctrine\ORM\Manager;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Doctrine\ORM\EntityManager;
use Xidea\Component\Product\Manager\ManufacturerManagerInterface,
    Xidea\Component\Product\Model\ManufacturerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ManufacturerManager implements ManufacturerManagerInterface
{
    /*
     * @var EntityManager
     */
    protected $entityManager;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * Constructs a manufacturer manager.
     *
     * @param EntityManager The entity manager
     */
    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ManufacturerInterface $manufacturer)
    {
        $this->entityManager->persist($manufacturer);

        $this->entityManager->flush();

        return $manufacturer->getId();
    }
    
    public function update(ManufacturerInterface $manufacturer)
    {  
        $this->entityManager->persist($manufacturer);

        $this->entityManager->flush();

        return $manufacturer->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ManufacturerInterface $manufacturer)
    {
        $this->entityManager->remove($manufacturer);
    }

}
