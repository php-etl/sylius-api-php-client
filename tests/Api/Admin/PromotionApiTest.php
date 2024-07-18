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

class PromotionApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetPromotions()
    {
        $address = new Api\Admin\PromotionApi(
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

    public function testGetPromotion()
    {
        $address = new Api\Admin\PromotionApi(
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

        $result = $address->get('new_year');

        $this->assertEquals('new_year', $result['code']);
        $this->assertEquals('New Year', $result['name']);
        $this->assertEquals(true, $result['exclusive']);
        $this->assertEquals(false, $result['couponBased']);
        $this->assertEquals(2, $result['priority']);
    }

    public function testCreatePromotion()
    {
        $address = new Api\Admin\PromotionApi(
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
            'code' => 'summer_sale',
            'name' => 'Summer Sale',
            'description' => 'Discount on all summer collection items',
            'priority' => 10,
            'exclusive' => true,
            'usageLimit' => 100,
            'startsAt' => '2024-07-16T13:12:25.375Z',
            'endsAt' => '2024-08-16T13:12:25.375Z',
            'couponBased' => true,
            'rules' => [
                [
                    'type' => 'item_total',
                    'configuration' => [
                        'FASHION_WEB' => [
                            'amount' => 10000,
                        ],
                    ],
                ],
            ],
            'actions' => [
                [
                    'type' => 'order_fixed_discount',
                    'configuration' => [
                        'FASHION_WEB' => [
                            'amount' => 15,
                        ],
                    ],
                ],
            ],
            'appliesToDiscounted' => true,
            'translations' => [
                'en_US' => [
                    'label' => 'Summer Sale',
                ],
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertPromotion()
    {
        $address = new Api\Admin\PromotionApi(
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

        $result = $address->upsert('new_year', [
            'exclusive' => false,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeletePromotion()
    {
        $address = new Api\Admin\PromotionApi(
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

        $result = $address->delete('new_year');

        $this->assertEquals(204, $result);
    }
}
