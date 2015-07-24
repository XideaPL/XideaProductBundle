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
    protected $director;
    
    /**
     * 
     * @param ConfigurationInterface $configuration
     * @param ProductDirectorInterface $director
     * @param ProductManagerInterface $manager
     * @param FormHandlerInterface $formHandler
     */
    public function __construct(ConfigurationInterface $configuration, ProductDirectorInterface $director, ProductManagerInterface $manager, FormHandlerInterface $formHandler)
    {
        parent::__construct($configuration, $manager, $formHandler);

        $this->director = $director;
        
        $this->createTemplate = 'product_create';
        $this->createFormTemplate = 'product_create_form';
    }

    /**
     * {@inheritdoc}
     */
    protected function createModel()
    {
        return $this->director->build();
    }

    /**
     * {@inheritdoc}
     */
    protected function onPreCreate($model, Request $request)
    {
        $this->dispatch(ProductEvents::PRE_CREATE, $event = new GetProductResponseEvent($model, $request));

        return $event->getResponse();
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    protected function onCreateCompleted($model, Request $request, Response $response)
    {
        $this->dispatch(ProductEvents::CREATE_COMPLETED, $event = new FilterProductResponseEvent($model, $request, $response));
        
        return $event->getResponse();
    }
}
