<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Admin;

use Diglin\Sylius\ApiClient\Api;
use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Client\ResourceClient;
use Diglin\Sylius\ApiClient\Pagination\PageFactory;
use Diglin\Sylius\ApiClient\Pagination\ResourceCursorFactory;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\Stream\MultipartStreamBuilderFactory;
use Diglin\Sylius\ApiClient\Stream\PatchResourceListResponseFactory;
use Diglin\Sylius\ApiClient\Stream\UpsertResourceListResponseFactory;
use Http\Adapter\Guzzle6\Client;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class CustomerApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetCustomers()
    {
        $address = new Api\Admin\CustomerApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator = new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
            new PageFactory($httpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->all();

        $this->assertEquals(21, iterator_count($result));
    }

    public function testGetCustomer()
    {
        $address = new Api\Admin\CustomerApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator = new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
            new PageFactory($httpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->get(1);

        $this->assertEquals('/api/v2/contexts/Customer', $result['@context']);
        $this->assertEquals('/api/v2/admin/customers/1', $result['@id']);
        $this->assertEquals('Customer', $result['@type']);
        $this->assertEquals(null, $result['defaultAddress']);
        $this->assertEquals('/api/v2/admin/shop-users/1', $result['user']['@id']);
        $this->assertEquals('ShopUser', $result['user']['@type']);
        $this->assertTrue($result['user']['enabled']);
        $this->assertFalse($result['user']['verified']);
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('shop@example.com', $result['email']);
        $this->assertEquals('John', $result['firstName']);
        $this->assertEquals('Doe', $result['lastName']);
        $this->assertEquals('2013-10-24 13:52:42', $result['birthday']);
        $this->assertEquals('u', $result['gender']);
        $this->assertEquals('/api/v2/admin/customer-groups/retail', $result['group']);
        $this->assertEquals('+1-443-251-1188', $result['phoneNumber']);
        $this->assertFalse($result['subscribedToNewsletter']);
        $this->assertEquals('2024-07-05 13:16:35', $result['createdAt']);
        $this->assertEquals('John Doe', $result['fullName']);
    }

    public function testCreateCustomer()
    {
        $address = new Api\Admin\CustomerApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator = new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
            new PageFactory($httpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->create([
            'user' => [
                'plainPassword' => 'securepassword123',
                'verified' => '2024-07-11T13:16:48.384Z',
                'enabled' => true,
            ],
            'email' => 'user@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'birthday' => '2024-07-11T13:16:48.384Z',
            'gender' => 'u',
            'group' => '/api/v2/admin/customer-groups/retail',
            'phoneNumber' => '+1-555-123-4567',
            'subscribedToNewsletter' => true,
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertCustomer()
    {
        $address = new Api\Admin\CustomerApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator = new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
            new PageFactory($httpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->upsert(1, [
            'firstName' => 'Marie',
            'lastName' => 'Curie',
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteCustomer()
    {
        $address = new Api\Admin\CustomerApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator = new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
            new PageFactory($httpClient, $uriGenerator),
            new ResourceCursorFactory()
        );

        $result = $address->delete(1);

        $this->assertEquals(204, $result);
    }
}
