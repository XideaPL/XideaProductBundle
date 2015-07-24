<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Xidea\Component\Product\Loader\ProductLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractShowController;
use Xidea\Component\Product\Model\ProductInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ShowController extends AbstractShowController
{
    /*
     * @var ProductLoaderInterface
     */
    protected $loader;

    /**
     * 
     * @param ConfigurationInterface $configuration
     * @param ProductLoaderInterface $loader
     */
    public function __construct(ConfigurationInterface $configuration, ProductLoaderInterface $loader)
    {
        parent::__construct($configuration);

        $this->loader = $loader;
        
        $this->showTemplate = 'product_show';
    }

    /**
     * {@inheritdoc}
     */
    protected function loadModel($id)
    {
        $product = $this->loader->load($id);

        if (!$product instanceof ProductInterface) {
            throw new NotFoundHttpException('product.not_found');
        }

        return $product;
    }

    /**
     * {@inheritdoc}
     */
    protected function onPreShow($object, Request $request)
    {
        return;
    }
}
