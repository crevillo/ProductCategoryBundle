<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\ProductCategoryStorage;

use eZ\Publish\Core\FieldType\StorageGateway;

abstract class Gateway extends StorageGateway
{
    /**
     * Gets the product category info associated to the id
     *
     * @param int $productCategoryId
     *
     * @return array
     */
    abstract public function getProductCategoryData( $productCategoryId );
}
