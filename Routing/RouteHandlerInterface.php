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
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface RouteHandlerInterface
{
    function handle($route, array $parameters = array(), $referenceType = RouterInterface::ABSOLUTE_PATH);
}
