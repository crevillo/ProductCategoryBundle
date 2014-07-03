<?php
/**
 * This file is part of the ProductCategoryBundle package
 *
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */

namespace Crevillo\ProductCategoryBundle\API\ProductCategory\Values;

use eZ\Publish\API\Repository\Values\ValueObject;

/**
 * @property-read string $name
 */
class ProductCategory extends ValueObject
{
    /**
     * @var string
     */
    protected $name;
}
