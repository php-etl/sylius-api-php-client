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

class ProductApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetProducts()
    {
        $address = new Api\Admin\ProductApi(
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

    public function testGetProduct()
    {
        $address = new Api\Admin\ProductApi(
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

        $result = $address->get('Knitted_burgundy_winter_cap');

        $this->assertEquals(7, $result['id']);
        $this->assertEquals('Knitted_burgundy_winter_cap', $result['code']);
        $this->assertEquals(true, $result['enabled']);
        $this->assertEquals(['/api/v2/admin/product-variants/Knitted_burgundy_winter_cap-variant-0'], $result['variants']);
    }

    public function testCreateProduct()
    {
        $address = new Api\Admin\ProductApi(
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
            'variantSelectionMethod' => 'choice',
            'channels' => [
                '/api/v2/admin/channels/FASHION_WEB',
            ],
            'mainTaxon' => '/api/v2/admin/taxons/t_shirts',
            'code' => 'product_123',
            'attributes' => [
                [
                    'attribute' => '/api/v2/admin/product-attributes/t_shirt_brand',
                    'localeCode' => 'en_US',
                    'value' => 'Nike',
                ],
            ],
            'options' => [
                '/api/v2/admin/product-options/t_shirt_size',
            ],
            'enabled' => true,
            'translations' => [
                'en_US' => [
                    'name' => 'Red T-shirt',
                    'slug' => 'red-t-shirt',
                    'description' => 'A comfortable red t-shirt',
                    'shortDescription' => 'Comfortable and stylish',
                    'metaKeywords' => 't-shirt, red, clothing',
                    'metaDescription' => 'A comfortable and stylish red t-shirt.',
                ],
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertProduct()
    {
        $address = new Api\Admin\ProductApi(
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

        $result = $address->upsert('Knitted_burgundy_winter_cap', [
            'enabled' => false,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteProduct()
    {
        $address = new Api\Admin\ProductApi(
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

        $result = $address->delete('Knitted_burgundy_winter_cap');

        $this->assertEquals(204, $result);
    }
}
