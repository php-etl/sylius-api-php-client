<?php

namespace Admin;

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

class ExchangeRateApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetExchangeRates()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

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

        $address = new Api\Admin\ExchangeRateApi(
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

        $result = $address->all(0);

        $this->assertEquals(1, iterator_count($result));
    }

    public function testGetEcxhangeRate()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

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

        $address = new Api\Admin\ExchangeRateApi(
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

        $result = $address->get(0);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals(1, $result['firstName']);
        $this->assertEquals(1, $result['lastName']);
        $this->assertEquals(1, $result['phoneNumber']);
        $this->assertEquals(1, $result['company']);
        $this->assertEquals(1, $result['street']);
        $this->assertEquals(1, $result['city']);
        $this->assertEquals(1, $result['postcode']);
    }

    public function testCreateExchangeRate()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

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

        $address = new Api\Admin\ExchangeRateApi(
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
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertExchangeRate()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

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

        $address = new Api\Admin\ExchangeRateApi(
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

        $result = $address->upsert(0, [
            "firstName" => "string",
            "lastName" => "string",
        ]);

        $this->assertEquals(201, $result);
    }

    public function testDeleteExchangeRate()
    {
        $httpClient = new HttpClient(
            new Client(),
            new RequestFactory(),
            new StreamFactory(),
        );

        $uriGenerator = new UriGenerator('http://localhost:8080/');

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

        $address = new Api\Admin\ExchangeRateApi(
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

        $result = $address->delete(0);

        $this->assertEquals(204, $result);
    }
}
