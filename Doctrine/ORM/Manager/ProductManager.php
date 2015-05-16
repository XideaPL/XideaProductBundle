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

use Xidea\Component\Base\Doctrine\ORM\Manager\ModelManagerInterface;

use Xidea\Component\Product\Manager\ProductManagerInterface,
    Xidea\Component\Product\Model\ProductInterface;

use Xidea\Bundle\ProductBundle\ProductEvents,
    Xidea\Bundle\ProductBundle\Event\ProductEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductManager implements ModelManagerInterface, ProductManagerInterface
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
     * Constructs a product manager.
     *
     * @param EntityManager The entity manager
     */
    public function __construct(EntityManager $entityManager, EventDispatcherInterface $eventDispatcher)
    {
        $this->entityManager = $entityManager;
        $this->eventDispatcher = $eventDispatcher;

        $this->setFlushMode(true);
    }
    
    /**
     * {@inheritdoc}
     */
    public function setFlushMode($flushMode = true)
    {
        $this->flushMode = $flushMode;
    }
    
    /**
     * {@inheritdoc}
     */
    public function isFlushMode()
    {
        return $this->flushMode;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ProductInterface $product)
    {
        $this->eventDispatcher->dispatch(ProductEvents::PRE_SAVE, new ProductEvent($product));
        
        $this->entityManager->persist($product);

        if($this->isFlushMode())
            $this->entityManager->flush();
        
        $this->eventDispatcher->dispatch(ProductEvents::POST_SAVE, new ProductEvent($product));

        return $product->getId();
    }
    
    public function update(ProductInterface $product)
    {  
        $this->entityManager->persist($product);

        if($this->isFlushMode())
            $this->entityManager->flush();

        return $product->getId();
    }

    /**
     * {@inheritdoc}
     */
    public function delete(ProductInterface $product)
    {
        return $this->entityManager->remove($product);
    }
    
    /**
     * {@inheritdoc}
     */
    public function flush()
    {
        $this->entityManager->flush();
    }
    
    /**
     * {@inheritdoc}
     */
    public function clear()
    {
        $this->entityManager->clear();
    }
}
