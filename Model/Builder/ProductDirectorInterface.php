<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Builder;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ProductDirectorInterface
{
    /**
     * @return \Xidea\Bundle\ProductBundle\Model\ProductInterface
     */
    function build();
}
