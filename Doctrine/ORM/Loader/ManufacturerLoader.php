<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Doctrine\ORM\Loader;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Xidea\Product\Manufacturer\LoaderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ManufacturerLoader implements LoaderInterface
{
    /*
     * @var EntityRepository
     */
    protected $manufacturerRepository;
    
    /**
     * Constructs a comment repository.
     *
     * @param string $class The class
     * @param EntityManager The entity manager
     */
    public function __construct(EntityRepository $manufacturerRepository)
    {
        $this->manufacturerRepository = $manufacturerRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function load($id)
    {
        return $this->manufacturerRepository->find($id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadAll()
    {
        return $this->manufacturerRepository->findAll();
    }

    /*
     * {@inheritdoc}
     */
    public function loadBy(array $criteria, array $orderBy = array(), $limit = null, $offset = null)
    {
        return $this->manufacturerRepository->findBy($criteria, $orderBy, $limit, $offset);
    }
    
    /*
     * {@inheritdoc}
     */
    public function loadOneBy(array $criteria, array $orderBy = array())
    {
        return $this->manufacturerRepository->findOneBy($criteria, $orderBy);
    }
}
