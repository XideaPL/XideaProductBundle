<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\EventDispatcher\EventDispatcherInterface,
    Symfony\Component\HttpFoundation\Request;

use Xidea\Component\Product\Loader\ProductLoaderInterface;
use Xidea\Bundle\ProductBundle\View\ViewHandlerInterface,
    Xidea\Bundle\ProductBundle\ProductEvents,
    Xidea\Bundle\ProductBundle\Event\FilterProductResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractViewController
{
    /*
     * @var ProductLoaderInterface
     */
    protected $productLoader;

    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /*
     * @var ViewHandlerInterface
     */
    protected $viewHandler;

    /*
     * @var TranslatorInterface
     */
    protected $translator;

    public function __construct(ProductLoaderInterface $productLoader, EventDispatcherInterface $eventDispatcher, ViewHandlerInterface $viewHandler)
    {
        $this->productLoader = $productLoader;
        $this->eventDispatcher = $eventDispatcher;
        $this->viewHandler = $viewHandler;
    }

    public function viewAction($id, Request $request)
    {
        $product = $this->loadProduct($id);
        
        $response = $this->viewHandler->handle('view', array(
                    'product' => $product
        ));
        
        $this->eventDispatcher->dispatch(ProductEvents::VIEW, new FilterProductResponseEvent($product, $request, $response));
        
        return $response;
    }
    
    protected function loadProduct($id)
    {
        $product = $this->productLoader->load($id);
        
        return $product;
    }

}
