<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Admin;

use Diglin\Sylius\ApiClient\Api;
use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Client\ResourceClient;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\Stream\MultipartStreamBuilderFactory;
use Diglin\Sylius\ApiClient\Stream\PatchResourceListResponseFactory;
use Diglin\Sylius\ApiClient\Stream\UpsertResourceListResponseFactory;
use Diglin\Sylius\ApiClient\tests\Api\Admin\Client\Address\GetAddressIsSuccessfull;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;

class AddressApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetAddress()
    {
        $address = new Api\Admin\AddressApi(
            new ResourceClient(
                new HttpClient(
                    new GetAddressIsSuccessfull(),
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

        $result = $address->get(57);

        $this->assertEquals(57, $result['id']);
        $this->assertEquals('Natasha', $result['firstName']);
        $this->assertEquals('Lynch', $result['lastName']);
        $this->assertEquals(null, $result['phoneNumber']);
        $this->assertEquals(null, $result['company']);
        $this->assertEquals('PL', $result['countryCode']);
        $this->assertEquals(null, $result['provinceCode']);
        $this->assertEquals(null, $result['provinceName']);
        $this->assertEquals('82913 Pfeffer Passage Apt. 930', $result['street']);
        $this->assertEquals('Port Clairefurt', $result['city']);
        $this->assertEquals('57417-2519', $result['postcode']);
    }

    public function testUpsertAddress()
    {
        $address = new Api\Admin\AddressApi(
            new ResourceClient(
                new HttpClient(
                    new GetAddressIsSuccessfull(),
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

        $result = $address->upsert(57, [
            'firstName' => 'Naomi',
            'lastName' => 'Von',
        ]);

        $this->assertEquals(200, $result);
    }
}
