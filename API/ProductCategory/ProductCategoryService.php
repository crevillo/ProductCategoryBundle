<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\API\ProductCategory;

interface ProductCategoryService
{
    /**
     * Loads the Product Category data for $productCategoryId
     * @param mixed $productCategoryId
     *
     * @return \Crevillo\ProductCategoryBundle\API\ProductCategory\Values\ProductCategory;
     */
    public function loadProductCategory( $productCategoryId );
}