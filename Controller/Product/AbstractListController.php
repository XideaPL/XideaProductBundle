<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

use Xidea\Bundle\ProductBundle\Model\Loader\ProductLoaderInterface,
    Xidea\Bundle\ProductBundle\View\ViewHandlerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractListController
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

    public function listAction()
    {
        $products = $this->productLoader->loadAll();

        return $this->viewHandler->handle('list', array(
                    'products' => $products
        ));
    }

}
