<?php

namespace Diglin\Sylius\ApiClient\tests\Shop;

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

class ChannelApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAllAddress()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\ShopApi($httpClient, $uriGenerator),
            Authentication::fromPassword('shop@example.com', 'sylius'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Shop\AddressApi(
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

        $results = $address->all();

        $this->assertEquals(1, iterator_count($results));
    }

    public function testGetAddress()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\ShopApi($httpClient, $uriGenerator),
            Authentication::fromPassword('shop@example.com', 'sylius'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Shop\AddressApi(
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

        $result = $address->get(58);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals(1, $result['firstName']);
        $this->assertEquals(1, $result['lastName']);
        $this->assertEquals(1, $result['phoneNumber']);
        $this->assertEquals(1, $result['company']);
        $this->assertEquals(1, $result['street']);
        $this->assertEquals(1, $result['city']);
        $this->assertEquals(1, $result['postcode']);
    }

    public function testCreateAddress()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\ShopApi($httpClient, $uriGenerator),
            Authentication::fromPassword('shop@example.com', 'sylius'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Shop\AddressApi(
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
            "firstName" => "string",
            "lastName" => "string",
            "phoneNumber" => "string",
            "company" => "string",
            "countryCode" => "string",
            "provinceCode" => "string",
            "provinceName" => "string",
            "street" => "string",
            "city" => "string",
            "postcode" => "string"
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpdateAddress()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\ShopApi($httpClient, $uriGenerator),
            Authentication::fromPassword('shop@example.com', 'sylius'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Shop\AddressApi(
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

        $results = $address->upsert(58, [
            "firstName" => "string",
            "lastName" => "string",
        ]);

        $this->assertEquals(1, 201);
    }

    public function testDeleteAddress()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

        $authenticatedHttpClient = new AuthenticatedHttpClient(
            $httpClient,
            new Api\Authentication\ShopApi($httpClient, $uriGenerator),
            Authentication::fromPassword('shop@example.com', 'sylius'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Shop\AddressApi(
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

        $result = $address->delete(58);

        $this->assertEquals(204, $result);
    }
}
