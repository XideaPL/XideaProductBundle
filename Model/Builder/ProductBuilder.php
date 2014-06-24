<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Builder;

use Symfony\Component\Security\Core\User\UserInterface;

use Xidea\Bundle\ProductBundle\Model\Factory\ProductFactoryInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductBuilder implements ProductBuilderInterface
{

    /**
     * Currently built product.
     *
     * @var ProductInterface
     */
    protected $product;

    /**
     * Product factory.
     *
     * @var ProductFactoryInterface
     */
    protected $factory;

    public function __construct(ProductFactoryInterface $productFactory)
    {
        $this->factory = $productFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->product = $this->factory->create();
    }

    /**
     * {@inheritdoc}
     */
    public function setAuthor(UserInterface $author)
    {
        $this->product->setAuthor($author);
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct()
    {
        return $this->product;
    }

}
