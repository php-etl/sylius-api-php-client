<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Authentication;

use Diglin\Sylius\ApiClient\Client\HttpClient;
use Diglin\Sylius\ApiClient\Exception\UnauthorizedHttpException;
use Diglin\Sylius\ApiClient\Routing\UriGenerator;
use Diglin\Sylius\ApiClient\tests\Api\Authentication\Client\OkResponse;
use Diglin\Sylius\ApiClient\tests\Api\Authentication\Client\UnauthorizedResponse;
use Http\Factory\Guzzle\RequestFactory;
use Http\Factory\Guzzle\StreamFactory;
use PHPUnit\Framework\TestCase;

class AdminApiTest extends TestCase
{
    public function testAuthenticate(): void
    {
        $admin = new \Diglin\Sylius\ApiClient\Api\Authentication\AdminApi(
            new HttpClient(
                new OkResponse(),
                new RequestFactory(),
                new StreamFactory(),
            ),
            new UriGenerator('https://sylius.com'),
        );

        $result = $admin->authenticateByPassword('api@example.com', 'sylius-api');

        $this->assertArrayHasKey('token', $result);
    }

    public function testAuthenticateWithInvalidCredentials(): void
    {
        $this->expectException(UnauthorizedHttpException::class);

        $admin = new \Diglin\Sylius\ApiClient\Api\Authentication\AdminApi(
            new HttpClient(
                new UnauthorizedResponse(),
                new RequestFactory(),
                new StreamFactory(),
            ),
            new UriGenerator('https://sylius.com'),
        );

        $admin->authenticateByPassword('api@example.com', 'sylius');
    }
}
