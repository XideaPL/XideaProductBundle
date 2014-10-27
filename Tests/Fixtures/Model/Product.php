<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 * 
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Tests\Fixtures\Model;

use Xidea\Component\Product\Model\AbstractProduct;

/**
 * @author Artur Pszczółka <artur.pszczolka@xidea.pl>
 */
class Product extends AbstractProduct
{
    public function setId($id)
    {
        $this->id = $id;
    }
}
