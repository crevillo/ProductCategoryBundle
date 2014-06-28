<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory;

use eZ\Publish\Core\FieldType\Value as BaseValue;

/**
 * Value for ProductCategory field type
 */
class Value extends BaseValue
{
    /**
     * Product Category
     *
     * @var mixed|null
     */
    public $productCategoryId;

    /**
     * Construct a new Value object and initialize it $destinationContent
     *
     * @param int|string $productCategoryId Id of the Product Category
     */
    public function __construct( $productCategoryId = null )
    {
        $this->productCategoryId = $productCategoryId;
    }

    /**
     * Returns the product category id
     * @todo Return product category name instead
     * @see \eZ\Publish\Core\FieldType\Value
     */
    public function __toString()
    {
        return (string)$this->productCategoryId;
    }
} 