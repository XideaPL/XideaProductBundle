<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\View;

use Symfony\Component\HttpFoundation\RedirectResponse,
    Symfony\Component\HttpFoundation\Response;

/**
 *
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ViewHandlerInterface
{
    function handle($view, array $parameters = array());
    
    function createRedirectResponse($url, $status = 302, $headers = array());
}
