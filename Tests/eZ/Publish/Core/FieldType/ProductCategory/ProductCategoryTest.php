<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */


namespace EzSystems\EzPriceBundle\Tests\eZ\Publish\Core\FieldType\Price\PriceTest;

use eZ\Publish\Core\FieldType\Tests\FieldTypeTest;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Type as ProductCategoryType;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value as ProductCategoryValue;

/**
 * @group fieldType
 * @group ezproductcategory
 * @covers \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Type
 * @covers \Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value
 */
class ProductCategoryTest extends FieldTypeTest
{
    protected function createFieldTypeUnderTest()
    {
        $fieldType = new ProductCategoryType();
        $fieldType->setTransformationProcessor( $this->getTransformationProcessorMock() );

        return $fieldType;
    }

    protected function getValidatorConfigurationSchemaExpectation()
    {
        return array();
    }

    protected function getSettingsSchemaExpectation()
    {
        return array();
    }

    protected function getEmptyValueExpectation()
    {
        return new ProductCategoryValue;
    }

    public function provideInvalidInputForAcceptValue()
    {
        return array(
            array(
                array(),
                'eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException',
            ),
            array(
                new ProductCategoryValue( array( 'productCategoryId' => true ) ),
                'eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException',
            ),
            array(
                new ProductCategoryValue( true ),
                'eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException',
            ),
            array(
                new ProductCategoryValue( 20.3 ),
                'eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException',
            )
        );
    }

    public function provideValidInputForAcceptValue()
    {
        return array(
            array(
                null,
                new ProductCategoryValue,
            ),
            array(
                1,
                new ProductCategoryValue( 1 ),
            ),
            array(
                'foo',
                new ProductCategoryValue( 'foo' ),
            )
        );
    }

    public function provideInputForToHash()
    {
        return array(
            array(
                new ProductCategoryValue(  1 ),
                array( 'productCategoryId' => 1 ),
            ),
            array(
                new ProductCategoryValue( 'foo' ),
                array( 'productCategoryId' => 'foo' ),
            ),
        );
    }

    public function provideInputForFromHash()
    {
        return array(
            array(
                null,
                new ProductCategoryValue,
            ),
            array(
                array( 'productCategoryId' => 23 ),
                new ProductCategoryValue( 23 ),
            ),
            array(
                array( 'productCategoryId' => 'foo' ),
                new ProductCategoryValue( 'foo' ),
            ),
        );
    }

    protected function provideFieldTypeIdentifier()
    {
        return 'ezproductcategory';
    }

    public function provideDataForGetName()
    {
        return array(
            array( $this->getEmptyValueExpectation(), "" ),
            array( new ProductCategoryValue( 23 ), "23" )
        );
    }

    public function provideValidDataForValidate()
    {
        return array(
            array(
                array(),
                new ProductCategoryValue( 8 ),
            ),
            array(
                array(),
                new ProductCategoryValue( 'foo' ),
            ),
        );
    }
}
