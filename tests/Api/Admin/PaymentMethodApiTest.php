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

class PaymentMethodApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetPaymentMethods()
    {
        $address = new Api\Admin\PaymentMethodApi(
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

        $this->assertEquals(2, iterator_count($result));
    }

    public function testGetPaymentMethod()
    {
        $address = new Api\Admin\PaymentMethodApi(
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

        $result = $address->get('cash_on_delivery');

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('cash_on_delivery', $result['code']);
        $this->assertEquals('/api/v2/admin/gateway-configs/1', $result['gatewayConfig']);
        $this->assertEquals([
            '/api/v2/admin/channels/FASHION_WEB',
        ], $result['channels']);
        $this->assertEquals(true, $result['enabled']);
        $this->assertEquals([
            'en_US' => [
                'name' => 'Cash on delivery',
                'description' => 'A cash on delivery',
            ],
        ], $result['translations']);
    }

    public function testCreatePaymentMethod()
    {
        $address = new Api\Admin\PaymentMethodApi(
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
            'channels' => [
                '/api/v2/admin/channels/FASHION_WEB',
            ],
            'gatewayConfig' => '/api/v2/admin/gateway-configs/1',
            'code' => 'credit_card',
            'position' => 1,
            'enabled' => true,
            'translations' => [
                'en_US' => [
                    'name' => 'Credit Card',
                    'description' => 'Payment via credit card',
                    'instructions' => 'Enter your credit card details at checkout.',
                ],
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertPaymentMethod()
    {
        $address = new Api\Admin\PaymentMethodApi(
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

        $result = $address->upsert('credit_card', [
            'enabled' => false,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeletePaymentMethod()
    {
        $address = new Api\Admin\PaymentMethodApi(
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

        $result = $address->delete('credit_card');

        $this->assertEquals(204, $result);
    }
}
