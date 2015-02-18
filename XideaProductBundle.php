<?php

namespace Xidea\Bundle\ProductBundle;

use Xidea\Bundle\BaseBundle\AbstractBundle;

class XideaProductBundle extends AbstractBundle
{
    protected function getModelNamespace()
    {
        return 'Xidea\Component\Product\Model';
    }
}
