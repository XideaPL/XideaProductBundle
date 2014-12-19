<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Provider;

use Symfony\Component\Security\Core\SecurityContextInterface;

use Xidea\Component\Product\Model\AuthorInterface,
    Xidea\Component\Product\Provider\AuthorProviderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class UserProvider implements AuthorProviderInterface
{
    protected $securityContext;
    
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }
    
    /**
     * @inheritDoc
     */
    public function provide()
    {
        $author = $this->securityContext->getToken()->getUser();
        
        if($author instanceof AuthorInterface) {
            return $author;
        }
        
        return null;            
    }
}
