<?php

/* 
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Form\Type;

use Xidea\Bundle\ProductBundle\Form\Type\ProductType,
    Xidea\Bundle\ProductBundle\Tests\Fixtures\Model\Product;

use Symfony\Component\Form\Test\TypeTestCase,
    Symfony\Component\Form\Forms,
    Symfony\Component\Form\FormBuilder,
    Symfony\Component\Form\Extension\Validator\Type\FormTypeValidatorExtension,
    Symfony\Component\Validator\ConstraintViolationList;

class ProductTypeTest extends TypeTestCase
{
    public function testSubmitValidData()
    {
        $formData = array(
            'sku' => '1234567890',
            'slug' => 'product-1',
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'shortDescription' => 'Product 1 short description',
            'url' => 'product-1.html',
            'price' => 39.90,
            'retailPrice' => 29.90,
            'qty' => 10,
            'image' => 'product-image.jpg',
            'imageLabel' => 'Product image label',
            'width' => 10,
            'height' => 10,
            'depth' => 10,
            'availableOn' => '2015-05-21'
        );
        
        $object = new Product();

        $type = new ProductType(get_class($object));

        $form = $this->factory->create($type);
        //$object->fromArray($formData);
        $form->setData($object);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertTrue($form->isValid());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
    
    protected function setUp()
    {
        parent::setUp();

        $validator = $this->getMock('\Symfony\Component\Validator\Validator\ValidatorInterface');
        $validator->method('validate')->will($this->returnValue(new ConstraintViolationList()));

        $this->factory = Forms::createFormFactoryBuilder()
            ->addExtensions($this->getExtensions())
            ->addTypeExtension(
                new FormTypeValidatorExtension(
                    $validator
                )
            )
            ->addTypeGuesser(
                $this->getMockBuilder(
                    'Symfony\Component\Form\Extension\Validator\ValidatorTypeGuesser'
                )
                ->disableOriginalConstructor()
                ->getMock()
            )
            ->getFormFactory();

        $this->dispatcher = $this->getMock('Symfony\Component\EventDispatcher\EventDispatcherInterface');
        $this->builder = new FormBuilder(null, null, $this->dispatcher, $this->factory);
    }
}