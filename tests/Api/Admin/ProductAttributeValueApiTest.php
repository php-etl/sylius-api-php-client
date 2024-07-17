<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Admin;

use Diglin\Sylius\ApiClient\Api;
use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Client\ResourceClient;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\Stream\MultipartStreamBuilderFactory;
use Diglin\Sylius\ApiClient\Stream\PatchResourceListResponseFactory;
use Diglin\Sylius\ApiClient\Stream\UpsertResourceListResponseFactory;
use Http\Adapter\Guzzle6\Client;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class ProductAttributeValueApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetProductAttributeValue()
    {
        $address = new Api\Admin\ProductAttributeValueApi(
            new ResourceClient(
                new HttpClient(
                    new Client(),
                    new RequestFactory(),
                    new StreamFactory(),
                ),
                new UriGenerator('https://sylius-api.com/'),
                new MultipartStreamBuilderFactory(
                    Psr17FactoryDiscovery::findStreamFactory(),
                ),
                new UpsertResourceListResponseFactory(),
                new PatchResourceListResponseFactory(),
            ),
        );

        $result = $address->get(7);

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('/api/v2/admin/product-attributes/t_shirt_brand', $result['attribute']);
        $this->assertEquals('pt_PT', $result['localeCode']);
        $this->assertEquals('You are breathtaking', $result['value']);
        $this->assertEquals('T-shirt brand', $result['name']);
        $this->assertEquals('text', $result['type']);
        $this->assertEquals('t_shirt_brand', $result['code']);
    }
}
