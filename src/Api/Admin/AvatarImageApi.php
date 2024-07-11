<?php declare(strict_types=1);

namespace Diglin\Sylius\ApiClient\Api\Admin;

use Diglin\Sylius\ApiClient\Client\ResourceClientInterface;
use Webmozart\Assert\Assert;

final class AvatarImageApi implements AvatarImageApiInterface
{
    public function __construct(
        private ResourceClientInterface $resourceClient,
    ) {}

    public function get($code): array
    {
        Assert::integer($code);
        return $this->resourceClient->getResource('api/v2/admin/avatar-images/%d', [$code]);
    }

    public function create(array $data = []): int
    {
        $response = $this->resourceClient->createMultipartResource('api/v2/admin/avatar-images', [], $data);

        return $response->getStatusCode();
    }

    public function delete($code): int
    {
        Assert::integer($code);
        return $this->resourceClient->deleteResource('api/v2/admin/avatar-images/%d', [$code]);
    }
}
