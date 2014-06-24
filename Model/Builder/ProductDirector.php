<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle\Model\Builder;

use Xidea\Bundle\ProductBundle\Model\Provider\AuthorProviderInterface;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
class ProductDirector implements ProductDirectorInterface
{
    protected $productBuilder;
    
    protected $authorProvider;
    
    public function __construct(ProductBuilderInterface $productBuilder, AuthorProviderInterface $authorProvider)
    {
        $this->productBuilder = $productBuilder;
        $this->authorProvider = $authorProvider;
    }
    
    public function build()
    {
        $this->productBuilder->create();
        $this->productBuilder->setAuthor($this->authorProvider->provide());
        
        return $this->productBuilder->getProduct();
    }
}
