<?php
/**
 * Diglin GmbH - Switzerland.
 *
 * @author      Sylvain Rayé <support at diglin.com>
 *
 * @category    SyliusApiClient
 *
 * @copyright   2020 - Diglin (https://www.diglin.com)
 */

namespace Diglin\Sylius\ApiClient\Api\Legacy;

use Diglin\Sylius\ApiClient\Api\ApiAwareInterface;
use Diglin\Sylius\ApiClient\Api\Operation\CreatableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\DeletableDoubleResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\GettableDoubleResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\ListableDoubleResourceInterface;

/** @deprecated */
interface ProductVariantsApiInterface extends ApiAwareInterface, CreatableResourceInterface, GettableDoubleResourceInterface, ListableDoubleResourceInterface, DeletableDoubleResourceInterface
{
}
