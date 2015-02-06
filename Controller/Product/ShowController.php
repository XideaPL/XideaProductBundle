<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

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

    protected $productLoader;

    public function __construct(ConfigurationInterface $configuration, ProductLoaderInterface $productLoader)
    {
        parent::__construct($configuration);

        $this->productLoader = $productLoader;
    }

    protected function loadObject($id)
    {
        $product = $this->productLoader->load($id);

        if (!$product instanceof ProductInterface) {
            throw new NotFoundHttpException('product.not_found');
        }

        return $product;
    }

    protected function onPreShow($object, $request)
    {
        return;
    }

    protected function onShowView(array $parameters = array(), $request = null)
    {
        return $this->render($this->getTemplateConfiguration()->getTemplate('show'), $parameters);
    }

}
