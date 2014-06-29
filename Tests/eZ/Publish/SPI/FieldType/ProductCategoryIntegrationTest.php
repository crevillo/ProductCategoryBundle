<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\Tests\eZ\Publish\SPI\FieldType;

use eZ\Publish\Core\Persistence\Legacy;
use eZ\Publish\Core\FieldType;
use eZ\Publish\SPI\Persistence\Content;
use eZ\Publish\SPI\Tests\FieldType\BaseIntegrationTest;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Type as ProductCategoryType;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value as ProductCategoryValue;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter\ProductCategory as ProductCategoryConverter;
use eZ\Publish\SPI\Persistence\Content\Field;

/**
 * @group fieldType
 * @group ezproductcategory
 */
class PriceIntegrationTest extends BaseIntegrationTest
{
    public function getTypeName()
    {
        return 'ezproductcategory';
    }

    public function getCustomHandler()
    {
        $fieldType = new ProductCategoryType();
        $fieldType->setTransformationProcessor( $this->getTransformationProcessor() );

        return $this->getHandler(
            'ezproductcategory',
            $fieldType,
            new ProductCategoryConverter(),
            new FieldType\NullStorage()
        );
    }

    /**
     * Returns the FieldTypeConstraints to be used to create a field definition
     * of the FieldType under test.
     *
     * @return \eZ\Publish\SPI\Persistence\Content\FieldTypeConstraints
     */
    public function getTypeConstraints()
    {
        return new Content\FieldTypeConstraints();
    }

    /**
     * Get field definition data values
     *
     * This is a PHPUnit data provider
     *
     * @return array
     */
    public function getFieldDefinitionData()
    {
        return array(
            array( 'fieldType', 'ezproductcategory' ),
            array( 'fieldTypeConstraints', new Content\FieldTypeConstraints() ),
        );
    }

    /**
     * Get initial field value
     *
     * @return \eZ\Publish\SPI\Persistence\Content\FieldValue
     */
    public function getInitialValue()
    {
        return new Content\FieldValue(
            array(
                'data' => new ProductCategoryValue( 25 ),
                'externalData' => null,
                'sortKey' => 25,
            )
        );
    }

    /**
     * Asserts that the loaded field data is correct
     *
     * Performs assertions on the loaded field, mainly checking that the
     * $field->value->externalData is loaded correctly. If the loading of
     * external data manipulates other aspects of $field, their correctness
     * also needs to be asserted. Make sure you implement this method agnostic
     * to the used SPI\Persistence implementation!
     */
    public function assertLoadedFieldDataCorrect( Field $field )
    {
        $this->assertEquals(
            $this->getInitialValue()->externalData,
            $field->value->externalData
        );

        $this->assertEquals( new ProductCategoryValue( 25 ), $field->value->data );
        $this->assertEquals( $field->value->sortKey, 25 );
    }
    /**
     * Get update field value.
     *
     * Use to update the field
     *
     * @return \eZ\Publish\SPI\Persistence\Content\FieldValue
     */
    public function getUpdatedValue()
    {
        return new Content\FieldValue(
            array(
                'data' => new ProductCategoryValue( 25 ),
                'externalData' => null,
                'sortKey' => 25,
            )
        );
    }

    public function assertUpdatedFieldDataCorrect( Field $field )
    {
        $this->assertEquals(
            $this->getUpdatedValue()->externalData,
            $field->value->externalData
        );

        $this->assertEquals( new ProductCategoryValue( 25 ), $field->value->data );
        $this->assertEquals( $field->value->sortKey, 25 );
    }
}
