<?php

/*
 * (c) Xidea Artur Pszczółka <biuro@xidea.pl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Xidea\Bundle\ProductBundle;

/**
 * @author Artur Pszczółka <a.pszczolka@xidea.pl>
 */
final class ProductEvents
{
    /**
     * The PRE_SAVE event occurs when the product is saved.
     */
    const PRE_SAVE = 'xidea_product.product.pre_save';
    
    /**
     * The POST_SAVE event occurs when the product is saved.
     */
    const POST_SAVE = 'xidea_product.product.post_save';
    
    /**
     * The CREATE_INITIALIZE event occurs when the create process is initialized.
     */
    const CREATE_INITIALIZE = 'xidea_product.product.create_initialize';
    
    /**
     * The PRE_CREATE event occurs when the create process is initialized.
     */
    const PRE_CREATE = 'xidea_product.product.pre_create';
    
    /**
     * The CREATE_SUCCESS event occurs when the create process is initialized.
     */
    const CREATE_SUCCESS = 'xidea_product.product.create_success';
    
    /**
     * The CREATE_FORM_VALID event occurs when the create process is initialized.
     */
    const CREATE_FORM_VALID = 'xidea_product.product.create_form_valid';
    
    /**
     * The CREATE_COMPLETED event occurs when the create process is initialized.
     */
    const CREATE_COMPLETED = 'xidea_product.product.create_completed';
    
}
