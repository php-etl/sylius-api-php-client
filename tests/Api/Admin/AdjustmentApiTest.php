<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Admin;

use Diglin\Sylius\ApiClient\Api;
use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Client\ResourceClient;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\Stream\MultipartStreamBuilderFactory;
use Diglin\Sylius\ApiClient\Stream\PatchResourceListResponseFactory;
use Diglin\Sylius\ApiClient\Stream\UpsertResourceListResponseFactory;
use Diglin\Sylius\ApiClient\tests\Api\Admin\Client\Adjustment\GetAdjustmentIsSuccessfull;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class AdjustmentApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAdjustment()
    {
        $address = new Api\Admin\AdjustmentApi(
            new ResourceClient(
                new HttpClient(
                    new GetAdjustmentIsSuccessfull(),
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

        $result = $address->get(16);

        $this->assertEquals(16, $result['id']);
        $this->assertEquals('/api/v2/admin/shipments/2', $result['shipment']);
        $this->assertEquals('/api/v2/admin/orders/KP~TpwzITjm400pN1eofTEvUODkEmpjUsvkbo1Lh-wp9CW5nEGC4deyoYNDfqGRd', $result['order']);
        $this->assertEquals('shipping', $result['type']);
        $this->assertEquals('FedEx', $result['label']);
        $this->assertEquals(285, $result['amount']);
    }
}
