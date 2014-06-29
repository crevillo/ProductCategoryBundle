<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\ProductCategoryStorage\Gateway;

use Crevillo\ProductCategoryBundle\eZ\Publish\Core\FieldType\ProductCategory\ProductCategoryStorage\Gateway;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use PDO;

class LegacyStorage extends Gateway
{
    /**
     * Connection
     *
     * @var mixed
     */
    protected $dbHandler;

    /**
     * Set database handler for this gateway
     *
     * @param mixed $dbHandler
     *
     * @return void
     * @throws \RuntimeException if $dbHandler is not an instance of
     *         {@link \eZ\Publish\Core\Persistence\Database\DatabaseHandler}
     */
    public function setConnection( $dbHandler )
    {
        if ( !$dbHandler instanceof DatabaseHandler )
        {
            throw new \RuntimeException( "Invalid dbHandler passed" );
        }

        $this->dbHandler = $dbHandler;
    }

    /**
     * Returns the active connection
     *
     * @throws \RuntimeException if no connection has been set, yet.
     *
     * @return \eZ\Publish\Core\Persistence\Database\DatabaseHandler
     */
    protected function getConnection()
    {
        if ( $this->dbHandler === null )
        {
            throw new \RuntimeException( "Missing database connection." );
        }
        return $this->dbHandler;
    }

    /**
     * Returns the data of the Product Category $productCategoryId
     *
     * @param int $productCategoryId
     * @return array
     */
    public function getProductCategoryData( $productCategoryId )
    {
        $dbHandler = $this->getConnection();

        $query = $dbHandler->createSelectQuery();
        $query->select( array( 'id', 'name' ) )
            ->from( $dbHandler->quoteTable( 'ezproductcategory' ) )
            ->where(
                $query->expr->eq(
                    $dbHandler->quoteColumn( 'id' ),
                    $query->bindValue( $productCategoryId, null, PDO::PARAM_INT )
                )
            );

        $statement = $query->prepare();
        $statement->execute();

        return $statement->fetch();
    }
}
