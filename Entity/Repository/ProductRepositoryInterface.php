<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Entity\Repository;

use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
interface ProductRepositoryInterface
{
    /**
     * Returns a query builder.
     * 
     * @return object
     */
    public function findByAuthorQB(UserInterface $author);
    
    /**
     * Returns a set of products by author.
     * 
     * @return array
     */
    public function findByAuthor(UserInterface $author);
}
