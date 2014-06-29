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
     * Product Category Id
     *
     * @var mixed|null
     */
    public $id;

    /**
     * Name of the category
     *
     * @var string
     */
    public $name = '';

    /**
     * Construct a new Value object
     *
     * @param int|string|array $values
     */
    public function __construct( $values = null )
    {
        if ( !is_array( $values ) )
            $values = array( 'id' => $values );

        parent::__construct( $values );
    }

    /**
     * Returns the product category name
     * @see \eZ\Publish\Core\FieldType\Value
     */
    public function __toString()
    {
        return (string)$this->name;
    }
} 