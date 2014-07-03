<?php
/**
 * This file is part of the ProductCategoryBundle package.
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\ApiLoader;

use eZ\Publish\Core\Persistence\Database\DatabaseHandler;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\Gateway\DoctrineDatabase;

class LegacyProductCategoryHandlerFactory
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    protected $container;

    /**
     * Constructor
     *
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct( ContainerInterface $container )
    {
        $this->container = $container;
    }

    /**
     * Builds the legacy product category handler
     *
     * @param \eZ\Publish\Core\Persistence\Database\DatabaseHandler $dbHandler
     *
     * @return \Crevillo\ProductCategoryBundle\Core\Persistence\Legacy\ProductCategory\ProductCategoryHandler
     */
    public function buildLegacyProductCategoryHandler( DatabaseHandler $dbHandler )
    {
        $legacyProductCategoryHandlerClass = $this->container->getParameter( "crevillo.productcategory.api.storage_engine.legacy.handler.ezproductcategory.class" );
        return new $legacyProductCategoryHandlerClass(
            new DoctrineDatabase( $dbHandler )
        );
    }
}
