<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Entity\Loader;

use Doctrine\ORM\EntityManager;

use Knp\Component\Pager\Paginator;

use Xidea\Component\Product\Loader\ProductLoaderInterface;

use Xidea\Bundle\ProductBundle\Entity\Repository\ProductRepositoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductLoader implements ProductLoaderInterface
{
    /*
     * @var ProductRepositoryInterface
     */
    protected $productRepository;
    
    /*
     * @var Paginator
     */
    protected $paginator;
    
    /**
     * Constructs a comment repository.
     *
     * @param string $class The class
     * @param EntityManager The entity manager
     */
    public function __construct(ProductRepositoryInterface $productRepository, Paginator $paginator)
    {
        $this->productRepository = $productRepository;
        $this->paginator = $paginator;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->productRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->productRepository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->productRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
}
