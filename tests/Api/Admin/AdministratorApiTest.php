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
use Diglin\Sylius\ApiClient\tests\Api\Admin\Client\Administrator\GetAdministratorsIsSuccessfull;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class AdministratorApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAdministrators()
    {
        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $address = new Api\Admin\AdministratorApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new GetAdministratorsIsSuccessfull(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator,
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

        $this->assertEquals(2, iterator_count($result));
    }

    public function testGetAdministrator()
    {
        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $address = new Api\Admin\AdministratorApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new GetAdministratorsIsSuccessfull(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator,
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

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('John', $result['firstName']);
        $this->assertEquals('Doe', $result['lastName']);
        $this->assertEquals('en_US', $result['localeCode']);
        $this->assertEquals('sylius', $result['username']);
        $this->assertEquals('sylius@example.com', $result['email']);
        $this->assertEquals(true, $result['enabled']);
        $this->assertEquals('/api/v2/admin/avatar-images/1', $result['avatar']);
    }

    public function testCreateAdministrator()
    {
        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $address = new Api\Admin\AdministratorApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new GetAdministratorsIsSuccessfull(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator,
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
            'firstName' => 'Marie',
            'lastName' => 'Curie',
            'email' => 'mariecurie@example.com',
            'enabled' => true,
            'username' => 'mariecurie',
            'plainPassword' => 'mariecurie1',
            'localeCode' => 'fr_FR',
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertAdministrator()
    {
        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $address = new Api\Admin\AdministratorApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new GetAdministratorsIsSuccessfull(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator,
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
            'firstName' => 'Robert',
            'lastName' => 'Smith',
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteAdministrator()
    {
        $uriGenerator = new UriGenerator('https://sylius-api.com/');

        $address = new Api\Admin\AdministratorApi(
            new ResourceClient(
                $httpClient = new HttpClient(
                    new GetAdministratorsIsSuccessfull(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                $uriGenerator,
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
