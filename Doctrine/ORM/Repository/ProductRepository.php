<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Doctrine\ORM\Repository;

use Doctrine\ORM\EntityRepository;

use Xidea\Component\Product\Model\AuthorInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    public function findByAuthorQB(AuthorInterface $author)
    {
        $qb = $this->createQueryBuilder('p');
        
        $qb
            ->select(array(
                'p',
                'p_author'
            ))
            ->join('p.author', 'p_author')
            ->where($qb->expr()->eq('p.author', ':authorId'))
            ->setParameters(array(
                'authorId' => $author->getId()
            ))
        ;

        $qb->orderBy('p.createdAt', 'DESC');

        return $qb;
    }
    
    public function findByAuthor(AuthorInterface $author)
    {
        $qb = $this->findByAuthorQB($author);

        return $qb->getQuery()->getResult();
    }
}
