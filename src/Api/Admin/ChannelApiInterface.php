<?php

namespace Diglin\Sylius\ApiClient\Api\Admin;

use Diglin\Sylius\ApiClient\Api\Operation\CreatableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\DeletableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\GettableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\ListableResourceInterface;
use Diglin\Sylius\ApiClient\Api\Operation\UpsertableResourceInterface;

interface ChannelApiInterface extends GettableResourceInterface, CreatableResourceInterface, UpsertableResourceInterface, ListableResourceInterface, DeletableResourceInterface
{
    public function shopBillingData(string $code): int;
}
