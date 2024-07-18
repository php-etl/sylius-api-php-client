<?php

namespace Diglin\Sylius\ApiClient\tests\Api\Authentication\Client;

use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UnauthorizedResponse implements ClientInterface
{
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        return new Response(
            401,
            body: json_encode([])
        );
    }
}
