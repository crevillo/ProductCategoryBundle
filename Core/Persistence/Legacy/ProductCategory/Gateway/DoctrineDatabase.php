<?php
/**
 * This file is part of the ProductCategoryBundle package.
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway;

use Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway;
use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use PDO;

class DoctrineDatabase extends Gateway
{
    /**
     * Database handler
     *
     * @var \eZ\Publish\Core\Persistence\Database\DatabaseHandler
     */
    protected $handler;

    /**
     * Construct from database handler
     *
     * @param \eZ\Publish\Core\Persistence\Database\DatabaseHandler $handler
     */
    public function __construct( DatabaseHandler $handler )
    {
        $this->handler = $handler;
    }

    /**
     * Returns an array with product category data
     *
     * @param mixed $productCategoryId
     *
     * @return array
     */
     public function getProductCategoryData( $productCategoryId )
     {
         $query = $this->handler->createSelectQuery();
         $query
             ->select( array( 'name' ) )
             ->from( $this->handler->quoteTable( 'ezproductcategory' ) )
             ->where(
                 $query->expr->eq(
                     $this->handler->quoteColumn( 'id' ),
                     $query->bindValue( $productCategoryId, null, PDO::PARAM_INT )
                 )
             );

         $statement = $query->prepare();
         $statement->execute();

         return $statement->fetch();
     }
}
