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

class ProductVariantApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetProductVariants()
    {
        $address = new Api\Admin\ProductVariantApi(
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

    public function testGetProductVariant()
    {
        $address = new Api\Admin\ProductVariantApi(
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

        $result = $address->get('Raglan_grey_&_black_Tee-variant-3');

        $this->assertEquals('Raglan_grey_&_black_Tee-variant-3', $result['code']);
        $this->assertEquals(false, $result['tracked']);
        $this->assertEquals(null, $result['weight']);
        $this->assertEquals(null, $result['width']);
        $this->assertEquals(null, $result['height']);
        $this->assertEquals(null, $result['depth']);
        $this->assertEquals('/api/v2/admin/tax-categories/clothing', $result['taxCategory']);
        $this->assertEquals('/api/v2/admin/products/Raglan_grey_%26_black_Tee', $result['product']);
        $this->assertEquals(true, $result['enabled']);
    }

    public function testCreateProductVariant()
    {
        $address = new Api\Admin\ProductVariantApi(
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
            'onHold' => 0,
            'onHand' => 100,
            'tracked' => true,
            'weight' => 500,
            'width' => 10,
            'height' => 5,
            'depth' => 20,
            'taxCategory' => '/api/v2/admin/tax-categories/other',
            'channelPricings' => [
                'FASHION_WEB' => [
                    'channelCode' => 'FASHION_WEB',
                    'price' => 2000,
                    'originalPrice' => 2500,
                    'minimumPrice' => 1800,
                ],
            ],
            'shippingRequired' => true,
            'code' => 'shoe_variant_123',
            'product' => '/api/v2/admin/products/Knitted_wool_blend_green_cap',
            'optionValues' => [
                '/api/v2/admin/product-option-values/size_36',
            ],
            'position' => 1,
            'enabled' => true,
            'translations' => [
                'en_US' => [
                    'name' => 'Red Shoe Size 42',
                ],
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertProductVariant()
    {
        $address = new Api\Admin\ProductVariantApi(
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

        $result = $address->upsert('Oversize_white_cotton_T_Shirt-variant-1', [
            'enabled' => false,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteProductVariant()
    {
        $address = new Api\Admin\ProductVariantApi(
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

        $result = $address->delete('Raglan_grey_&_black_Tee-variant-3');

        $this->assertEquals(204, $result);
    }
}
