<?php declare(strict_types=1);

namespace Diglin\Sylius\ApiClient\Api\Admin;

use Diglin\Sylius\ApiClient\Api\Operation\DeletableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\GettableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\ListableResourceInterface;

interface PromotionApiInterface extends GettableResourceInterface, ListableResourceInterface, DeletableResourceInterface
{
}
