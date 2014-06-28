<?php
/**
 * This file is part of the ProductCategoryBundle package.
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory;

abstract class Gateway
{
    /**
     * Returns an array with product category data
     *
     * @param mixed $productCategoryId
     *
     * @return array
     */
    abstract public function getProductCategoryData( $productCategoryId );
}