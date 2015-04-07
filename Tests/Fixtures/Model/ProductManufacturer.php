<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Fixtures\Model;

use Xidea\Component\Product\Model\AbstractManufacturer;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class ProductManufacturer extends AbstractManufacturer
{
    public function setId($id)
    {
        $this->id = $id;
    }
}