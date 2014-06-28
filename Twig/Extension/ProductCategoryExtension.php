<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
namespace Crevillo\ProductCategoryBundle\Twig\Extension;

use Crevillo\ProductCategoryBundle\API\ProductCategory\ProductCategoryService;
use Crevillo\ProductCategoryBundle\API\ProductCategory\Values\ProductCategory;
use Twig_Extension;
use Twig_SimpleFunction;

class ProductCategoryExtension extends Twig_Extension
{
    /**
     * @var \Crevillo\ProductCategoryBundle\API\ProductCategory\ProductCategoryService
     */
    private $productCategoryService;

    public function __construct( ProductCategoryService $productCategoryService )
    {
        $this->productCategoryService = $productCategoryService;
    }
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "ezproductcategory";
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array
     */
    public function getFunctions()
    {
        return array(
            new Twig_SimpleFunction(
                'ezproductcategory_data',
                array( $this, 'productCategoryData' ),
                array( 'is_safe' => array( 'html' ) )
            )
        );
    }

    /**
     * Returns the price associated to the Field $price and Version $versionNo without VAT applied
     *
     * @param int $productCategoryId
     *
     * @return \Crevillo\ProductCategoryBundle\API|ProductCategory\Values\ProductCategory
     */
    public function productCategoryData( $productCategoryId )
    {
        return $this->productCategoryService->loadProductCategory( $productCategoryId );
    }
} 