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

class CurrencyDataApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetCurrencies()
    {
        $address = new Api\Admin\CurrencyApi(
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

        $result = $address->all(0);

        $this->assertEquals(9, iterator_count($result));
    }

    public function testGetCurrency()
    {
        $address = new Api\Admin\CurrencyApi(
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

        $result = $address->get('EUR');

        $this->assertEquals('EUR', $result['code']);
        $this->assertEquals('Euro', $result['name']);
    }

    public function testCreateCurrency()
    {
        $address = new Api\Admin\CurrencyApi(
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
            'code' => 'JPY',
        ]);

        $this->assertEquals(201, $result);
    }
}
