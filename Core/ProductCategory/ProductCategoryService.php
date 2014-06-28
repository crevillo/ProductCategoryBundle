<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\Core\ProductCategory;

use Crevillo\ProductCategoryBundle\API\ProductCategory\ProductCategoryService as ProductCategoryServiceInterface;
use Crevillo\ProductCategoryBundle\SPI\Persistence\ProductCategory\ProductCategoryHandler;

class ProductCategoryService implements ProductCategoryServiceInterface
{
    /**
     * @var \Crevillo\ProductCategoryBundle\SPI\Persistence\ProductCategory\ProductCategoryHandler
     */
    protected $productCategoryHandler;

    /**
     * Constructor
     *
     * @param \Crevillo\ProductCategoryBundle\SPI\Persistence\ProductCategory\ProductCategoryHandler $productCategoryHandler
     */
    public function __construct( ProductCategoryHandler $productCategoryHandler )
    {
        $this->productCategoryHandler = $productCategoryHandler;
    }

    /**
     * Loads the Product Category data for $productCategoryId
     * @param mixed $productCategoryId
     *
     * @return \Crevillo\ProductCategoryBundle\API\ProductCategory\Values\ProductCategory;
     */
    public function loadProductCategory( $productCategoryId )
    {
        return $this->productCategoryHandler->load( $productCategoryId );
    }
} 