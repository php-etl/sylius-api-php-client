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

class ChannelApiTest extends \PHPUnit\Framework\TestCase
{
    public function testGetChannels()
    {
        $address = new Api\Admin\ChannelApi(
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

    public function testGetChannel()
    {
        $address = new Api\Admin\ChannelApi(
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

        $result = $address->get('FASHION_WEB');

        $this->assertEquals('/api/v2/admin/channels/FASHION_WEB', $result['@id']);
        $this->assertEquals('Channel', $result['@type']);
        $this->assertEquals('/api/v2/admin/currencies/USD', $result['baseCurrency']);
        $this->assertEquals('/api/v2/admin/locales/en_US', $result['defaultLocale']);
        $this->assertEquals('/api/v2/admin/zones/US', $result['defaultTaxZone']);
        $this->assertEquals('order_items_based', $result['taxCalculationStrategy']);
        $this->assertEquals(['/api/v2/admin/currencies/USD'], $result['currencies']);
        $this->assertEquals(['/api/v2/admin/locales/en_US'], $result['locales']);
        $this->assertEquals([], $result['countries']);
        $this->assertEquals(null, $result['themeName']);
        $this->assertEquals('contact@example.com', $result['contactEmail']);
        $this->assertEquals('+41 123 456 789', $result['contactPhoneNumber']);
        $this->assertFalse($result['skippingShippingStepAllowed']);
        $this->assertFalse($result['skippingPaymentStepAllowed']);
        $this->assertTrue($result['accountVerificationRequired']);
        $this->assertFalse($result['shippingAddressInCheckoutRequired']);
        $this->assertEquals('/api/v2/admin/shop-billing-datas/1', $result['shopBillingData']);
        $this->assertEquals('/api/v2/admin/taxons/MENU_CATEGORY', $result['menuTaxon']);
        $this->assertEquals('/api/v2/admin/channel-price-history-configs/1', $result['channelPriceHistoryConfig']);
        $this->assertEquals('FASHION_WEB', $result['code']);
        $this->assertEquals('Fashion Web Store', $result['name']);
        $this->assertEquals(null, $result['description']);
        $this->assertEquals('localhost', $result['hostname']);
        $this->assertEquals('#3ac47c', $result['color']);
        $this->assertTrue($result['enabled']);
    }

    public function testCreateChannel()
    {
        $address = new Api\Admin\ChannelApi(
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
            'baseCurrency' => '/api/v2/admin/currencies/USD',
            'defaultLocale' => '/api/v2/admin/locales/en_US',
            'defaultTaxZone' => '/api/v2/admin/zones/US',
            'taxCalculationStrategy' => 'order_items_based',
            'currencies' => [
                '/api/v2/admin/currencies/USD',
            ],
            'locales' => [
                '/api/v2/admin/locales/en_US',
            ],
            'countries' => [
                '/api/v2/admin/countries/US',
            ],
            'themeName' => 'ModernTheme',
            'contactEmail' => 'support@fakestore.com',
            'contactPhoneNumber' => '+1 800 123 4567',
            'skippingShippingStepAllowed' => true,
            'skippingPaymentStepAllowed' => true,
            'accountVerificationRequired' => true,
            'shippingAddressInCheckoutRequired' => true,
            'menuTaxon' => '/api/v2/admin/taxons/MENU_CATEGORY',
            'code' => 'FAKE_STORE',
            'name' => 'Fake Store',
            'description' => 'A fictitious store for testing purposes.',
            'hostname' => 'fake.store.com',
            'color' => '#FF5733',
            'enabled' => true,
        ]);

        $this->assertEquals(201, $result);
    }

    public function testUpsertChannel()
    {
        $address = new Api\Admin\ChannelApi(
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

        $result = $address->upsert('FAKE_STORE', [
            'baseCurrency' => '/api/v2/admin/currencies/EUR',
            'enabled' => false,
        ]);

        $this->assertEquals(200, $result);
    }

    public function testDeleteChannel()
    {
        $address = new Api\Admin\ChannelApi(
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

        $result = $address->delete('FAKE_STORE');

        $this->assertEquals(204, $result);
    }
}
