<?php

namespace Xidea\Bundle\ProductBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class ProductRepository extends EntityRepository implements ProductRepositoryInterface
{
    public function findByAuthorQB(UserInterface $author)
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
    
    public function findByAuthor(UserInterface $author)
    {
        $qb = $this->findByAuthorQB($author);

        return $qb->getQuery()->getResult();
    }
}
