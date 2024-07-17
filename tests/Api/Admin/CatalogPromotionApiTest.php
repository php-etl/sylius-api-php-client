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

class CatalogPromotionApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetCatalogPromotions()
    {
        $address = new Api\Admin\CatalogPromotionApi(
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

    public function testGetCatalogPromotion()
    {
        $address = new Api\Admin\CatalogPromotionApi(
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

        $result = $address->get('winter');

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('winter', $result['code']);
        $this->assertEquals('Winter sale', $result['name']);
        $this->assertEquals('processing', $result['state']);
        $this->assertEquals(true, $result['enabled']);
        $this->assertEquals(['/api/v2/admin/channels/FASHION_WEB'], $result['channels']);
    }

    public function testCreateCatalogPromotion()
    {
        $address = new Api\Admin\CatalogPromotionApi(
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
            'name' => 'Summer Sale',
            'code' => 'SUMMER2024',
            'startDate' => '2024-07-12T09:32:53.593Z',
            'endDate' => '2024-08-12T09:32:53.593Z',
            'priority' => 10,
            'exclusive' => true,
            'scopes' => [
                [
                    'type' => 'for_variants',
                    'configuration' => [
                        'variants' => [
                            'Everyday_white_basic_T_Shirt-variant-0',
                        ],
                    ],
                ],
            ],
            'actions' => [
                [
                    'type' => 'percentage_discount',
                    'configuration' => [
                        'amount' => 0.10,
                    ],
                ],
            ],
            'enabled' => true,
            'translations' => [
                'en_US' => [
                    'label' => 'Summer Sale 2024',
                    'description' => 'Get ready for the hottest deals of the summer!',
                ],
                'fr_FR' => [
                    'label' => 'Soldes d\'été 2024',
                    'description' => 'Préparez-vous pour les meilleures offres de l\'été!',
                ],
            ],
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertCatalogPromotion()
    {
        $address = new Api\Admin\CatalogPromotionApi(
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

        $result = $address->upsert('summer', [
            'actions' => [
                [
                    'type' => 'percentage_discount',
                    'configuration' => [
                        'amount' => 0.10,
                    ],
                ],
            ],
            'enabled' => true,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteCatalogPromotion()
    {
        $address = new Api\Admin\CatalogPromotionApi(
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

        $result = $address->delete('summer');

        $this->assertEquals(202, $result);
    }
}
