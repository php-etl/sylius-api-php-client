<?php

namespace Diglin\Sylius\ApiClient\tests\Admin;

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

class AddressApiTest extends \PHPUnit\Framework\TestCase
{
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
            new Api\Authentication\AdminApi($httpClient, $uriGenerator),
            Authentication::fromPassword('api@example.com', 'sylius-api'),
        );

        $multipartStreamBuilderFactory = new MultipartStreamBuilderFactory(
            Psr17FactoryDiscovery::findStreamFactory(),
        );
        $upsertListResponseFactory = new UpsertResourceListResponseFactory();
        $patchListResponseFactory = new PatchResourceListResponseFactory();

        $address = new Api\Admin\AddressApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
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

    public function testUpsertAddress()
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

        $address = new Api\Admin\AddressApi(
            new ResourceClient(
                $authenticatedHttpClient,
                $uriGenerator,
                $multipartStreamBuilderFactory,
                $upsertListResponseFactory,
                $patchListResponseFactory,
            ),
        );

        $result = $address->upsert(58, [
            "firstName" => "string",
            "lastName" => "string",
        ]);

        $this->assertEquals(1, $result);
    }
}
