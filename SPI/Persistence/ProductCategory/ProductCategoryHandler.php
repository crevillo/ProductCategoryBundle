<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\SPI\Persistence\ProductCategory;

interface ProductCategoryHandler
{
    /**
     * Loads the info for Product Category $productCategoryId
     *
     * @param $productCategoryId
     * @return \Crevillo\ProductCategoryBundle\API\ProductCategory\Values\ProductCategory
     */
    public function load( $productCategoryId );
}
