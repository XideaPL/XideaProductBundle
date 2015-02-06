<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Model;

use Xidea\Bundle\ProductBundle\Tests\Fixtures\Model\Product,
    Xidea\Bundle\ProductBundle\Tests\Fixtures\Model\User;

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
    
    public function testAuthor()
    {
        $product = $this->createProduct();
        $this->assertNull($product->getAuthor());
        
        $username = 'johndoe';
        $author = $this->createAuthor();
        $author->setUsername($username);
        
        $product->setAuthor($author);
        
        $productAuthor = $product->getAuthor();
        $this->assertSame($author, $productAuthor);
        $this->assertEquals($username, $productAuthor->getUsername());
    }
    
    protected function createProduct()
    {
        return new Product();
    }
    
    protected function createAuthor()
    {
        return new User();
    }
}
