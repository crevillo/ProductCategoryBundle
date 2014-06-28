<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory;

use Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway;
use Crevillo\ProductCategoryBundle\API\ProductCategory\Values\ProductCategory as ProductCategoryValue;
use Crevillo\ProductCategoryBundle\SPI\Persistence\ProductCategory\ProductCategoryHandler as ProductCategoryHandlerInterface;

class ProductCategoryHandler implements ProductCategoryHandlerInterface
{
    /**
     * @var \Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway
     */
    protected $gateway;

    /**
     * Constructor
     *
     * @param \Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway $gateway
     */
    public function __construct( Gateway $gateway )
    {
        $this->gateway = $gateway;
    }

    /**
     * @param int $productCategoryId
     * @return \Crevillo\ProductCategoryBundle\API\ProductCategory\Values\ProductCategory
     */
    public function load( $productCategoryId )
    {
        $productCategoryData = $this->gateway->getProductCategoryData( $productCategoryId );
        return new ProductCategoryValue( $productCategoryData );
    }
}