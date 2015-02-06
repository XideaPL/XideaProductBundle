<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Controller\Product;

use Xidea\Bundle\ProductBundle\Tests\Controller\ControllerTestCase;

class ShowControllerTest extends ControllerTestCase
{
    public function testShowAction()
    {
        //$client = $this->logIn();
        $client = $this->createClient();
        $product = $client->getContainer()->get('xidea_product.product.loader')->loadOneBy(array('name'=>'Product 1'));
        
        $crawler = $client->request('GET', $client->getContainer()->get('router')->generate('xidea_product_show', array('id'=>$product->getId())));

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Product 1")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Product 1 description")')->count()
        );
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Autor")')->count()
        );
    }
}

