<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\EventDispatcher\EventDispatcherInterface;
        
use Xidea\Bundle\ProductBundle\Model\Builder\ProductDirectorInterface,
    Xidea\Bundle\ProductBundle\Model\Manager\ProductManagerInterface,
    Xidea\Bundle\ProductBundle\Form\Factory\FormFactoryInterface,
    Xidea\Bundle\ProductBundle\ProductEvents,
    Xidea\Bundle\ProductBundle\Event\GetResponseEvent,
    Xidea\Bundle\ProductBundle\Event\GetProductResponseEvent,
    Xidea\Bundle\ProductBundle\Event\FilterProductResponseEvent,
    Xidea\Bundle\ProductBundle\Event\FormEvent,
    Xidea\Bundle\ProductBundle\Routing\RouteHandlerInterface,
    Xidea\Bundle\ProductBundle\View\ViewHandlerInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
abstract class AbstractCreateController
{
    /*
     * @var ProductDirectorInterface
     */
    protected $productDirector;

    /*
     * @var ProductManagerInterface
     */
    protected $productManager;

    /*
     * @var FormFactoryInterface
     */
    protected $formFactory;
    
    /*
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;
    
    /*
     * @var RouteHandlerInterface
     */
    protected $routeHandler;

    /*
     * @var ViewHandlerInterface
     */
    protected $viewHandler;

    /*
     * @var array
     */
    protected $options;

    public function __construct(ProductDirectorInterface $productDirector, ProductManagerInterface $productManager, FormFactoryInterface $formFactory, EventDispatcherInterface $eventDispatcher, RouteHandlerInterface $routeHandler, ViewHandlerInterface $viewHandler)
    {
        $this->productDirector = $productDirector;
        $this->productManager = $productManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->formFactory = $formFactory;
        $this->routeHandler = $routeHandler;
        $this->viewHandler = $viewHandler;
    }

    public function createAction(Request $request)
    {
        $event = new GetResponseEvent($request);
        $this->eventDispatcher->dispatch(ProductEvents::CREATE_INITIALIZE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $product = $this->productDirector->build();

        $event = new GetProductResponseEvent($product, $request);
        $this->eventDispatcher->dispatch(ProductEvents::PRE_CREATE, $event);

        if (null !== $event->getResponse()) {
            return $event->getResponse();
        }

        $form = $this->formFactory->createForm();
        $form->setData($product);

        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $event = new FormEvent($form, $request);
                $this->eventDispatcher->dispatch(ProductEvents::CREATE_FORM_VALID, $event);

                if ($this->manager->save($product)) {
                    $event = new GetProductResponseEvent($product, $request);
                    $this->eventDispatcher->dispatch(ProductEvents::CREATE_SUCCESS, $event);

                    if (null === $response = $event->getResponse()) {
                        $url = $this->routeHandler->handle('view', array(
                            'id' => $product->getId()
                        ));
                        $response = new RedirectResponse($url);
                    }

                    $this->eventDispatcher->dispatch(ProductEvents::CREATE_COMPLETED, new FilterProductResponseEvent($product, $request, $response));

                    return $response;
                }
            }
        }

        return $this->viewHandler->handle('create', array(
                    'form' => $form->createView()
        ));
    }

    public function createFormAction()
    {
        $form = $this->formFactory->createForm();

        return $this->viewHandler->handle('create_form', array(
                    'form' => $form->createView()
        ));
    }
}
