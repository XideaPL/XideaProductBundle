<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Controller\Product;

use Xidea\Bundle\ProductBundle\Tests\Controller\ControllerTestCase;

class CreateControllerTest extends ControllerTestCase
{
    public function testCreateAction()
    {
        $this->logIn();
        /*
         * @var \Symfony\Component\Routing\RouterInterface
         */
        $router = $this->client->getContainer()->get('router');

        $crawler = $this->client->request('GET', $router->generate('xidea_product_create'));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Nowy produkt")')->count()
        );
    }
}

