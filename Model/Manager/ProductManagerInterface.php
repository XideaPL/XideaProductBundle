<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Manager;

use Xidea\Bundle\ProductBundle\Model\ProductInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ProductManagerInterface
{
    /**
     * Saves a product.
     * 
     * @param ProductInterface $product
     */
    function save(ProductInterface $product);

    /**
     * Updates a product.
     * 
     * @param ProductInterface $product
     */
    function update(ProductInterface $product);

    /**
     * Deletes a product.
     * 
     * @param ProductInterface $product
     */
    function delete(ProductInterface $product);
}
