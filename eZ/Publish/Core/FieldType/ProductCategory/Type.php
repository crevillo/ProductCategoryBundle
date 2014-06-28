<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory;

use eZ\Publish\Core\FieldType\FieldType;
use eZ\Publish\Core\Base\Exceptions\InvalidArgumentType;
use eZ\Publish\SPI\FieldType\Value as SPIValue;
use eZ\Publish\Core\FieldType\Value as BaseValue;

/**
 * The ProductCategory field type.
 *
 * This field type represents a relation to a content.
 */
class Type extends FieldType
{
    public function getFieldTypeIdentifier()
    {
        return "ezproductcategory";
    }

    /**
     * Returns the name of the given field value.
     *
     * @param \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value $value
     *
     * @return string
     */
    public function getName( SPIValue $value )
    {
        return (string)$value->productCategoryId;
    }

    /**
     * Throws an exception if value structure is not of expected format.
     *
     * @throws \eZ\Publish\API\Repository\Exceptions\InvalidArgumentException If the value does not match the expected structure.
     *
     * @param \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value $value
     *
     * @return void
     */
    protected function checkValueStructure( BaseValue $value )
    {
        if ( !is_integer( $value->productCategoryId ) && !is_string( $value->productCategoryId ) )
        {
            throw new InvalidArgumentType(
                '$value->productCategoryId',
                'string|int',
                $value->productCategoryId
            );
        }
    }

    /**
     * Returns the fallback default value of field type when no such default
     * value is provided in the field definition in content types.
     *
     * @return \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value $value
     */
    public function getEmptyValue()
    {
        return new Value();
    }

    /**
     * Converts an $hash to the Value defined by the field type
     *
     * @param mixed $hash
     *
     * @return \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value $value
     */
    public function fromHash( $hash )
    {
        if ( $hash === null )
        {
            return $this->getEmptyValue();
        }
        return new Value( $hash );
    }

    /**
     * Converts a $Value to a hash
     *
     * @param \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value $value
     *
     * @return mixed
     */
    public function toHash( SPIValue $value )
    {
        if ( $this->isEmptyValue( $value ) )
        {
            return null;
        }
        return (array)$value;
    }

    /**
     * Returns if the given $value is considered empty by the field type
     *
     * @param mixed $value
     *
     * @return boolean
     */
    public function isEmptyValue( SPIValue $value )
    {
        return ( ( $value->productCategoryId === null ) || ( $value->productCategoryId === 0 ) );
    }

    /**
     * Inspects given $inputValue and potentially converts it into a dedicated value object.
     *
     * @param int|string $inputValue
     *
     * @return \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value The potentially converted and structurally plausible value.
     */
    protected function createValueFromInput( $inputValue )
    {
        if ( is_integer( $inputValue ) || is_string( $inputValue ) )
        {
            $inputValue = new Value( $inputValue );
        }

        return $inputValue;
    }

    /**
     * Returns information for FieldValue->$sortKey relevant to the field type.
     * For this FieldType, the related object's name is returned.
     *
     * @param \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value $value
     *
     * @return mixed
     */
    protected function getSortInfo( BaseValue $value )
    {
        return (string)$value;
    }

    /**
     * Returns whether the field type is searchable
     *
     * @return boolean
     */
    public function isSearchable()
    {
        return true;
    }
}
