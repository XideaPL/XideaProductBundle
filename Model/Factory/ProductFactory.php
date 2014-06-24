<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Factory;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductFactory implements ProductFactoryInterface
{
    protected $class;
    
    public function __construct($class)
    {
        $this->class = $class;
    }
    
    public function create()
    {
        return new $this->class;
    }
}
