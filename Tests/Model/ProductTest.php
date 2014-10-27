<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Model;

use Xidea\Bundle\ProductBundle\Tests\Fixtures\Model\Product;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testId()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getId());
        
        $product->setId(1);
        $this->assertEquals(1, $product->getId());
    }
    
    protected function createProduct()
    {
        return new Product();
    }
}
