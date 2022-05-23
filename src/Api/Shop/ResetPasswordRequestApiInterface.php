<?php declare(strict_types=1);

namespace Diglin\Sylius\ApiClient\Api\Shop;

use Diglin\Sylius\ApiClient\Api\Operation\CreatableResourceInterface;

interface ResetPasswordRequestApiInterface extends CreatableResourceInterface
{
    public function verify(string $token): int;
}
