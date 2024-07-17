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

class ShippingCategoryApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetShippingCategories()
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

        $address = new Api\Admin\ShippingCategoryApi(
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

        $this->assertEquals(1, iterator_count($result));
    }

    public function testGetShippingCategory()
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

        $address = new Api\Admin\ShippingCategoryApi(
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

        $result = $address->get('standard_shipping');

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('standard_shipping', $result['code']);
        $this->assertEquals('Standard Shipping', $result['name']);
        $this->assertEquals('Standard shipping method for all orders', $result['description']);
    }

    public function testCreateShippingCategory()
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

        $address = new Api\Admin\ShippingCategoryApi(
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
            'code' => 'standard_shipping',
            'name' => 'Standard Shipping',
            'description' => 'Standard shipping method for all orders',
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertShippingCategory()
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

        $address = new Api\Admin\ShippingCategoryApi(
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

        $result = $address->upsert('standard_shipping', [
            'name' => 'Standard Shipping',
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteShippingCategory()
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

        $address = new Api\Admin\ShippingCategoryApi(
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

        $result = $address->delete('standard_shipping');

        $this->assertEquals(204, $result);
    }
}
