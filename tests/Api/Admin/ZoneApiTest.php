<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Admin;

use Diglin\Sylius\ApiClient\Api;
use Diglin\Sylius\ApiClient\Client\AuthenticatedHttpClient;
use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Client\ResourceClient;
use Diglin\Sylius\ApiClient\Pagination\PageFactory;
use Diglin\Sylius\ApiClient\Pagination\ResourceCursorFactory;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\Security\Authentication;
use Diglin\Sylius\ApiClient\Stream\MultipartStreamBuilderFactory;
use Diglin\Sylius\ApiClient\Stream\PatchResourceListResponseFactory;
use Diglin\Sylius\ApiClient\Stream\UpsertResourceListResponseFactory;
use Http\Adapter\Guzzle6\Client;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class ZoneApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetZones()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\AdminApi($httpClient, $uriGenerator),
            Authentication::fromPassword('api@example.com', 'sylius-api'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Admin\ZoneApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
            new PageFactory($authenticatedHttpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->all();

        $this->assertEquals(2, iterator_count($result));
    }

    public function testGetZone()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\AdminApi($httpClient, $uriGenerator),
            Authentication::fromPassword('api@example.com', 'sylius-api'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Admin\ZoneApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
            new PageFactory($authenticatedHttpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->get('WORLD');

        $this->assertEquals(2, $result['id']);
        $this->assertEquals('WORLD', $result['code']);
        $this->assertEquals('Rest of the World', $result['name']);
        $this->assertEquals('country', $result['type']);
        $this->assertEquals('all', $result['scope']);
        $this->assertEquals([
            '/api/v2/admin/zone-members/2',
        ], $result['members']);
    }

    public function testCreateZone()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\AdminApi($httpClient, $uriGenerator),
            Authentication::fromPassword('api@example.com', 'sylius-api'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Admin\ZoneApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
            new PageFactory($authenticatedHttpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->create([
            'code' => 'eu_zone',
            'name' => 'European Zone',
            'type' => 'country',
            'scope' => 'all',
            'members' => [
                '/api/v2/admin/zone-members/1',
                '/api/v2/admin/zone-members/2',
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertZone()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\AdminApi($httpClient, $uriGenerator),
            Authentication::fromPassword('api@example.com', 'sylius-api'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Admin\ZoneApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
            new PageFactory($authenticatedHttpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->upsert('WORLD', [
            'members' => [
                [
                    'code' => 'FR',
                ],
                [
                    'code' => 'DE',
                ],
                [
                    'code' => 'ES',
                ],
            ],
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteZone()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\AdminApi($httpClient, $uriGenerator),
            Authentication::fromPassword('api@example.com', 'sylius-api'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Admin\ZoneApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
            new PageFactory($authenticatedHttpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->delete('WORLD');

        $this->assertEquals(204, $result);
    }
}
