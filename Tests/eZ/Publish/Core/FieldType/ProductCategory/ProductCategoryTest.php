<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */


namespace Crevillo\ProductCategoryBundle\Tests\eZ\Publish\Core\FieldType\ProductCategory;

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
                new ProductCategoryValue( array( 'id' => true ) ),
                'eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException',
            ),
            array(
                new ProductCategoryValue( array( 'id' => array( 5 ) ) ),
                'eZ\\Publish\\Core\\Base\\Exceptions\\InvalidArgumentException',
            ),
            array(
                new ProductCategoryValue( array( 'id' => 4.3 ) ),
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
                1,
                new ProductCategoryValue( array( 'id' => 1, 'name' => '' ) ),
            ),
            array(
                'foo',
                new ProductCategoryValue( array( 'id' => 'foo', 'name' => '' ) ),
            )
        );
    }

    public function provideInputForToHash()
    {
        return array(
            array(
                new ProductCategoryValue(
                    array( 'id' => 1 )
                ),
                array(
                    'id' => 1,
                    'name' => ''
                ),
            ),
            array(
                new ProductCategoryValue(
                    10
                ),
                array(
                    'id' => 10,
                    'name' => ''
                ),
            ),
            array(
                new ProductCategoryValue(
                    array( 'id' => 'foo' )
                ),
                array(
                    'id' => 'foo',
                    'name' => ''
                ),
            ),
            array(
                new ProductCategoryValue(
                    array( 'id' => 1, 'name' => 'foo' )
                ),
                array(
                    'id' => 1,
                    'name' => 'foo'
                ),
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
                array( 'id' => 23 ),
                new ProductCategoryValue(
                    array( 'id' => 23 )
                ),
            ),
            array(
                array( 'id' => 'foo' ),
                new ProductCategoryValue(
                    array( 'id' => 'foo' )
                ),
            ),
            array(
                array(
                    'id' => 'foo',
                    'name' => 'foo'
                ),
                new ProductCategoryValue(
                    array(
                        'id' => 'foo',
                        'name' => 'foo'
                    )
                ),
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
