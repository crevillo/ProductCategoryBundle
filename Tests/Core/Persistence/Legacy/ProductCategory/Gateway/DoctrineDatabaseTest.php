<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\Tests\eZ\Publish\Core\Persistence\Legacy\ProductCategory\Gateway;

use eZ\Publish\Core\Persistence\Legacy\Tests\TestCase;
use Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway\DoctrineDatabase;

class DoctrineDatabaseTest extends TestCase
{
    /**
     * Sets up the test suite
     */
    public function setUp()
    {
        parent::setUp();

        $handler = $this->getDatabaseHandler();
        $schema = __DIR__ . "/../../../../../_fixtures/schema/schema." . $this->db . ".sql";

        $queries = array_filter( preg_split( "(;\\s*$)m", file_get_contents( $schema ) ) );
        foreach ( $queries as $query )
        {
            $handler->exec( $query );
        }
    }

    /**
     * @return array
     */
    public static function getLoadProductCategoryValues()
    {
        return array(
            array( "name", 'Books' )
        );
    }

    /**
     * Returns gateway implementation for legacy storage
     *
     * @return \Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway\DoctrineDatabase
     */
    protected function getProductCategoryGateway()
    {
        $dbHandler = $this->getDatabaseHandler();
        return new DoctrineDatabase( $dbHandler );
    }

    /**
     * @dataProvider getLoadProductCategoryValues
     * @covers \Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway\DoctrineDatabase::getProductCategoryGateway
     *
     * @param string $field
     * @param mixed $value
     */
    public function testGetProductCategoryData( $field, $value )
    {
        $this->insertDatabaseFixture( __DIR__ . "/../../../../../_fixtures/productcategories.php" );
        $handler = $this->getProductCategoryGateway();
        $data = $handler->getProductCategoryData( 1 );

        $this->assertEquals(
            $value,
            $data[$field],
            "Value in property $field not as expected."
        );
    }
}
