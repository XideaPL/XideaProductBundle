<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Model;

use Xidea\Bundle\ProductBundle\Tests\Fixtures\Model\ProductManufacturer;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class ProductManufacturertTest extends \PHPUnit_Framework_TestCase
{
    public function testId()
    {
        $manufacturer = $this->createProductManufacturer();
        $this->assertNull($manufacturer->getId());
        
        $manufacturer->setId(1);
        $this->assertEquals(1, $manufacturer->getId());
    }
    
    public function testName()
    {
        $manufacturer = $this->createProductManufacturer();
        $this->assertNull($manufacturer->getName());
        
        $name = 'Manufacturer 1';
        
        $manufacturer->setName($name);
        $this->assertEquals($name, $manufacturer->getName());
    }
    
    protected function createProductManufacturer()
    {
        return new ProductManufacturer();
    }
}
