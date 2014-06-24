<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Provider;

use Symfony\Component\Security\Core\SecurityContextInterface,
    Symfony\Component\Security\Core\User\UserInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class AuthorProvider implements AuthorProviderInterface
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
        if($author instanceof UserInterface)
            return $author;
        
        return null;            
    }
}
