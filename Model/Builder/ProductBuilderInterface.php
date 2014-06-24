<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Builder;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ProductBuilderInterface
{
    /**
     * @return void
     */
    function create();
    
    /**
     * @param UserInterface $author
     */
    function setAuthor(UserInterface $author);
    
    /**
     * @return \Xidea\Bundle\ProductBundle\Model\ProductInterface
     */
    function getProduct();
}
