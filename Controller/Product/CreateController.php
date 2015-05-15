<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Controller\Product;

use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response;
use Xidea\Component\Product\Builder\ProductDirectorInterface,
    Xidea\Component\Product\Manager\ProductManagerInterface;
use Xidea\Bundle\BaseBundle\ConfigurationInterface,
    Xidea\Bundle\BaseBundle\Controller\AbstractCreateController,
    Xidea\Bundle\BaseBundle\Form\Handler\FormHandlerInterface;
use Xidea\Bundle\ProductBundle\ProductEvents,
    Xidea\Bundle\ProductBundle\Event\GetProductResponseEvent,
    Xidea\Bundle\ProductBundle\Event\FilterProductResponseEvent;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class CreateController extends AbstractCreateController
{
    /*
     * @var ProductDirectorInterface
     */

    protected $productDirector;

    /*
     * @var ProductManagerInterface
     */
    protected $productManager;

    public function __construct(ConfigurationInterface $configuration, ProductDirectorInterface $productDirector, ProductManagerInterface $modelManager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration, $modelManager, $formHandler);

        $this->productDirector = $productDirector;
    }

    protected function createModel()
    {
        return $this->productDirector->build();
    }

    protected function onPreCreate($model, Request $request)
    {
        $this->dispatch(ProductEvents::PRE_CREATE, $event = new GetProductResponseEvent($model, $request));

        return $event->getResponse();
    }

    protected function onCreateSuccess($model, Request $request)
    {
        $this->dispatch(ProductEvents::CREATE_SUCCESS, $event = new GetProductResponseEvent($model, $request));

        if (null === $response = $event->getResponse()) {
            $response = $this->redirectToRoute('xidea_product_show', array(
                'id' => $model->getId()
            ));
        }

        return $response;
    }

    protected function onCreateCompleted($model, Request $request, Response $response)
    {
        $this->dispatch(ProductEvents::CREATE_COMPLETED, new FilterProductResponseEvent($model, $request, $response));
    }
}
