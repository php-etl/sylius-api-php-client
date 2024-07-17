<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Admin;

use Diglin\Sylius\ApiClient\Api;
use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Client\ResourceClient;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\Stream\MultipartStreamBuilderFactory;
use Diglin\Sylius\ApiClient\Stream\PatchResourceListResponseFactory;
use Diglin\Sylius\ApiClient\Stream\UpsertResourceListResponseFactory;
use Http\Adapter\Guzzle6\Client;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class AvatarImageApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAvatarImage()
    {
        $address = new Api\Admin\AvatarImageApi(
            new ResourceClient(
                new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
        );

        $result = $address->get(3);

        $this->assertEquals(2, $result['id']);
        $this->assertEquals('https://sylius-api.com/media/cache/resolve/sylius_original/d2/59/a3f73a4d3b2df8d1bd047f0860ec.jpg', $result['path']);
        $this->assertEquals('/api/v2/admin/administrators/2', $result['owner']);
    }

    public function testCreateAvatarImage()
    {
        $address = new Api\Admin\AvatarImageApi(
            new ResourceClient(
                new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
        );

        $result = $address->create([
            [
                'name' => 'owner',
                'contents' => '/api/v2/admin/administrators/2',
            ],
            [
                'name' => 'file',
                'contents' => fopen('/home/sebastien/Téléchargements/images.png', 'r'),
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testDeleteAvatarImage()
    {
        $address = new Api\Admin\AvatarImageApi(
            new ResourceClient(
                new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
        );

        $result = $address->delete(2);

        $this->assertEquals(204, $result);
    }
}
