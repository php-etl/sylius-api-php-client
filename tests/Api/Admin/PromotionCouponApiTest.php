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

class PromotionCouponApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetPromotionCoupons()
    {
        $address = new Api\Admin\PromotionCouponApi(
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

        $this->assertEquals(1, iterator_count($result));
    }

    public function testGetPromotionCoupon()
    {
        $address = new Api\Admin\PromotionCouponApi(
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

        $result = $address->get('CHRISTMAS_SALE');

        $this->assertEquals('CHRISTMAS_SALE', $result['code']);
        $this->assertEquals(10, $result['usageLimit']);
        $this->assertEquals(0, $result['used']);
        $this->assertEquals('/api/v2/admin/promotions/christmas', $result['promotion']);
        $this->assertEquals(1, $result['perCustomerUsageLimit']);
    }

    public function testCreatePromotionCoupon()
    {
        $address = new Api\Admin\PromotionCouponApi(
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
            'perCustomerUsageLimit' => 1,
            'reusableFromCancelledOrders' => true,
            'code' => 'SUMMER2024',
            'usageLimit' => 100,
            'promotion' => '/api/v2/admin/promotions/christmas',
            'expiresAt' => '2024-07-16T13:26:33.614Z',
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertPromotionCoupon()
    {
        $address = new Api\Admin\PromotionCouponApi(
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

        $result = $address->upsert('CHRISTMAS_SALE', [
            'usageLimit' => 100,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeletePromotionCoupon()
    {
        $address = new Api\Admin\PromotionCouponApi(
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

        $result = $address->delete('CHRISTMAS_SALE');

        $this->assertEquals(204, $result);
    }
}
