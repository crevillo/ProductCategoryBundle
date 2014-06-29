<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Crevillo\ProductCategoryBundle\Tests\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter;

use eZ\Publish\SPI\Persistence\Content\FieldValue;
use eZ\Publish\Core\Persistence\Legacy\Content\StorageFieldValue;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\Value as ProductCategoryValue;
use Crevillo\ProductCategoryBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter\ProductCategory as ProductCategoryConverter;
use PHPUnit_Framework_TestCase;

/**
 * Test case for Product Category converter in Legacy storage
 *
 * @group fieldType
 * @group ezproductcategory
 */
class ProductCategoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Crevillo\ProductCategoryBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter\ProductCategory
     */
    protected $converter;

    protected function setUp()
    {
        parent::setUp();
        $this->converter = new ProductCategoryConverter;
    }

    /**
     * @covers \Crevillo\ProductCategoryBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter\ProductCategory::toStorageValue
     */
    public function testToStorageValue()
    {
        $productCategoryId = 1;

        $fieldValue = new FieldValue(
            array( 'data' => new ProductCategoryValue( $productCategoryId ) )
        );

        $storageFieldValue = new StorageFieldValue;

        $this->converter->toStorageValue( $fieldValue, $storageFieldValue );

        self::assertEquals( $productCategoryId, $storageFieldValue->dataInt );

        $fieldValue = new FieldValue(
            array( 'data' => new ProductCategoryValue( array( 'id' => $productCategoryId ) ) )
        );

        $storageFieldValue = new StorageFieldValue;

        $this->converter->toStorageValue( $fieldValue, $storageFieldValue );

        self::assertEquals( $productCategoryId, $storageFieldValue->dataInt );

        $fieldValue = new FieldValue(
            array(
                'data' => new ProductCategoryValue(
                    array(
                        'id' => $productCategoryId,
                        'name'=> 'foo',
                    )
                )
            )
        );

        $storageFieldValue = new StorageFieldValue;

        $this->converter->toStorageValue( $fieldValue, $storageFieldValue );

        self::assertEquals( $productCategoryId, $storageFieldValue->dataInt );
    }

    /**
     * @covers \Crevillo\ProductCategoryBundle\eZ\Publish\Core\Persistence\Legacy\Content\FieldValue\Converter\ProductCategory::toFieldValue
     */
    public function testToFieldValue()
    {
        $productCategoryId = 3;

        $storageFieldValue = new StorageFieldValue(
            array(
                'dataInt' => $productCategoryId,
            )
        );

        $fieldValue = new FieldValue;

        $this->converter->toFieldValue( $storageFieldValue, $fieldValue );

        self::assertEquals( $productCategoryId, $fieldValue->data->id );
    }
}
