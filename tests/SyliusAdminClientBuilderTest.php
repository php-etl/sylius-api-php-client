<?php

namespace Diglin\Sylius\ApiClient\tests;

use Diglin\Sylius\ApiClient\MissingBaseUriException;
use Diglin\Sylius\ApiClient\SyliusAdminClientBuilder;
use Diglin\Sylius\ApiClient\SyliusAdminClientInterface;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use PHPUnit\Framework\TestCase;

class SyliusAdminClientBuilderTest extends TestCase
{
    public function testBuildAuthenticatedByTokenWithoutBaseUri()
    {
        $this->expectException(MissingBaseUriException::class);

        $clientBuilder = new SyliusAdminClientBuilder();
        $clientBuilder->buildAuthenticatedByToken('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa');
    }

    public function testBuildAuthenticatedByTokenWithBaseUri()
    {
        $clientBuilder = new SyliusAdminClientBuilder();
        $client = $clientBuilder
            ->setBaseUri('https://api.sylius.com')
            ->buildAuthenticatedByToken('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa');

        $this->assertInstanceOf(SyliusAdminClientInterface::class, $client);
    }
    public function testBuildAuthenticatedByTokenWithDefaultHeaders()
    {
        $clientBuilder = new SyliusAdminClientBuilder();
        $client = $clientBuilder
            ->setBaseUri('https://api.sylius.com')
            ->setDefaultHeaders([
                'Content-Type' => 'application/json',
            ])
            ->buildAuthenticatedByToken('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa');

        $this->assertInstanceOf(SyliusAdminClientInterface::class, $client);
    }

    public function testBuildAuthenticatedByTokenWithHttpClient()
    {
        $clientBuilder = new SyliusAdminClientBuilder();
        $client = $clientBuilder
            ->setBaseUri('https://api.sylius.com')
            ->setHttpClient(
                new \Http\Adapter\Guzzle6\Client(),
            )
            ->buildAuthenticatedByToken('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa');

        $this->assertInstanceOf(SyliusAdminClientInterface::class, $client);
    }

    public function testBuildAuthenticatedByTokenWithRequestFactory()
    {
        $clientBuilder = new SyliusAdminClientBuilder();
        $client = $clientBuilder
            ->setBaseUri('https://api.sylius.com')
            ->setRequestFactory(
                new RequestFactory(),
            )
            ->buildAuthenticatedByToken('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa');

        $this->assertInstanceOf(SyliusAdminClientInterface::class, $client);
    }

    public function testBuildAuthenticatedByTokenWithStreamFactory()
    {
        $clientBuilder = new SyliusAdminClientBuilder();
        $client = $clientBuilder
            ->setBaseUri('https://api.sylius.com')
            ->setStreamFactory(
                new StreamFactory(),
            )
            ->buildAuthenticatedByToken('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa');

        $this->assertInstanceOf(SyliusAdminClientInterface::class, $client);
    }

    public function testBuildAAuthenticatedByPasswordWithoutBaseUri()
    {
        $this->expectException(MissingBaseUriException::class);

        $clientBuilder = new SyliusAdminClientBuilder();
        $clientBuilder->buildAuthenticatedByPassword('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa', '');
    }

    public function testBuildAuthenticatedByPassword()
    {
        $clientBuilder = new SyliusAdminClientBuilder();
        $client = $clientBuilder
            ->setBaseUri('https://api.sylius.com')
            ->buildAuthenticatedByPassword('lvhadhpzJakFGDK7LDy0u9uOB7VsKR2C5X1gCM6bduYvRod0BpYrrQVE1iZGayZa', '');

        $this->assertInstanceOf(SyliusAdminClientInterface::class, $client);
    }
}
