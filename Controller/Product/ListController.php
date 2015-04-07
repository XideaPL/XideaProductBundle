<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\HttpFoundation\Request;
use Xidea\Component\Product\Loader\ProductLoaderInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractListController;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ListController extends AbstractListController
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
    
    protected function loadObjects(Request $request)
    {
        return $this->productLoader->loadAll();
    }
    
    protected function onPreList($objects, Request $request)
    {
        return;
    }
}
