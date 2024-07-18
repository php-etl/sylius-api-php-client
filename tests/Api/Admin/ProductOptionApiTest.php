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

class ProductOptionApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetProductOptions()
    {
        $address = new Api\Admin\ProductOptionApi(
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

        $this->assertEquals(4, iterator_count($result));
    }

    public function testGetProductOption()
    {
        $address = new Api\Admin\ProductOptionApi(
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

        $result = $address->get('t_shirt_size');

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('t_shirt_size', $result['code']);
        $this->assertEquals('T-shirt size', $result['name']);
        $this->assertEquals('T-shirt size', $result['values']);
        $this->assertEquals([
            '/api/v2/admin/product-option-values/t_shirt_size_s',
            '/api/v2/admin/product-option-values/t_shirt_size_m',
            '/api/v2/admin/product-option-values/t_shirt_size_l',
        ], $result['values']);
    }

    public function testCreateProductOption()
    {
        $address = new Api\Admin\ProductOptionApi(
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
            'code' => 'shoes_size',
            'position' => 1,
            'values' => [
                [
                    'code' => 'size_36',
                    'translations' => [
                        'en_US' => [
                            'value' => '36',
                        ],
                    ],
                ],
                [
                    'code' => 'size_37',
                    'translations' => [
                        'en_US' => [
                            'value' => '37',
                        ],
                    ],
                ],
                [
                    'code' => 'size_38',
                    'translations' => [
                        'en_US' => [
                            'value' => '38',
                        ],
                    ],
                ],
                [
                    'code' => 'size_39',
                    'translations' => [
                        'en_US' => [
                            'value' => '39',
                        ],
                    ],
                ],
                [
                    'code' => 'size_40',
                    'translations' => [
                        'en_US' => [
                            'value' => '40',
                        ],
                    ],
                ],
                [
                    'code' => 'size_41',
                    'translations' => [
                        'en_US' => [
                            'value' => '41',
                        ],
                    ],
                ],
                [
                    'code' => 'size_42',
                    'translations' => [
                        'en_US' => [
                            'value' => '42',
                        ],
                    ],
                ],
                [
                    'code' => 'size_43',
                    'translations' => [
                        'en_US' => [
                            'value' => '43',
                        ],
                    ],
                ],
                [
                    'code' => 'size_44',
                    'translations' => [
                        'en_US' => [
                            'value' => '44',
                        ],
                    ],
                ],
                [
                    'code' => 'size_45',
                    'translations' => [
                        'en_US' => [
                            'value' => '45',
                        ],
                    ],
                ],
            ],
            'translations' => [
                'en_US' => [
                    'name' => 'Shoe Size',
                ],
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertProductOption()
    {
        $address = new Api\Admin\ProductOptionApi(
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

        $result = $address->upsert('t_shirt_size', [
            'values' => [
                '/api/v2/admin/product-option-values/t_shirt_size_xxl',
            ],
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteProductOption()
    {
        $address = new Api\Admin\ProductOptionApi(
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

        $result = $address->delete('t_shirt_size');

        $this->assertEquals(204, $result);
    }
}
