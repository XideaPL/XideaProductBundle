<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\TicketBundle\Routing;

use Symfony\Component\Routing\RouterInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class RouteHandler implements RouteHandlerInterface
{
    /*
     * @var RouterInterface
     */
    protected $router;
    
    /*
     * @var array
     */
    protected $routes;
    
    /*
     * @var array
     */
    protected $templates;
    
    /**
     * Constructs a route handler.
     *
     * @param RouterInterface The router
     */
    public function __construct(RouterInterface $router, array $routes = array())
    {
        $this->router = $router;
        
        $this->routes = array_replace_recursive(array(
            'view' => 'xidea_ticket_view'
        ), $routes);
    }

    /**
     * {@inheritdoc}
     */
    public function handle($route, array $parameters = array(), $referenceType = RouterInterface::ABSOLUTE_PATH)
    {
        return $this->router->generate($this->routes[$route], $parameters, $referenceType);
    }
}
