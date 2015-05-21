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
    
    public function testSku()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getSku());
        
        $sku = '1234567890';
        
        $product->setSku($sku);
        $this->assertEquals($sku, $product->getSku());
    }
    
    public function testSlug()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getSlug());
        
        $slug = 'product-1';
        
        $product->setSlug($slug);
        $this->assertEquals($slug, $product->getSlug());
    }
    
    public function testName()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getName());
        
        $name = 'Product 1';
        
        $product->setName($name);
        $this->assertEquals($name, $product->getName());
    }
    
    public function testDescription()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getDescription());
        
        $description = 'Product 1 description';
        
        $product->setDescription($description);
        $this->assertEquals($description, $product->getDescription());
    }
    
    public function testShortDescription()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getShortDescription());
        
        $description = 'Product 1 short description';
        
        $product->setShortDescription($description);
        $this->assertEquals($description, $product->getShortDescription());
    }
    
    public function testUrl()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getUrl());
        
        $url = 'product-1.html';
        
        $product->setUrl($url);
        $this->assertEquals($url, $product->getUrl());
    }
    
    public function testPrice()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getPrice());
        
        $price = 29.90;
        
        $product->setPrice($price);
        $this->assertEquals($price, $product->getPrice());
    }
    
    public function testRetailPrice()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getRetailPrice());
        
        $retailPrice = 39.90;
        
        $product->setRetailPrice($retailPrice);
        $this->assertEquals($retailPrice, $product->getRetailPrice());
    }
    
    public function testQty()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getQty());
        
        $qty = 10;
        
        $product->setQty($qty);
        $this->assertEquals($qty, $product->getQty());
    }
    
    public function testWidth()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getWidth());
        
        $width = 10;
        
        $product->setWidth($width);
        $this->assertEquals($width, $product->getWidth());
    }
    
    public function testHeight()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getHeight());
        
        $height = 10;
        
        $product->setHeight($height);
        $this->assertEquals($height, $product->getHeight());
    }
    
    public function testDepth()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getDepth());
        
        $depth = 10;
        
        $product->setDepth($depth);
        $this->assertEquals($depth, $product->getDepth());
    }
    
    public function testAvailableOn()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getAvailableOn());
        $product->setAvailableOn();
        $this->assertNull($product->getAvailableOn());

        $date = new \DateTime();
        
        $product->setAvailableOn($date);
        $this->assertEquals($date, $product->getAvailableOn());
    }
    
    public function testCreatedAt()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getCreatedAt());
        $product->setCreatedAt();
        $this->assertNull($product->getCreatedAt());

        $date = new \DateTime();
        
        $product->setCreatedAt($date);
        $this->assertEquals($date, $product->getCreatedAt());
    }
    
    public function testUpdatedAt()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getUpdatedAt());
        $product->setCreatedAt();
        $this->assertNull($product->getUpdatedAt());

        $date = new \DateTime();
        
        $product->setUpdatedAt($date);
        $this->assertEquals($date, $product->getUpdatedAt());
    }
    
    protected function createProduct()
    {
        return new Product();
    }
}
