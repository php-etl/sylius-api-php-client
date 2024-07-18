<?php

namespace Diglin\Sylius\ApiClient;

use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

/** @internal */
interface ClientBuilderInterface
{
    public function setBaseUri(string $baseUri): self;

    public function setDefaultHeaders(array $headers): self;

    public function setHttpClient(ClientInterface $httpClient): self;

    public function setRequestFactory(RequestFactoryInterface $requestFactory): self;

    public function setStreamFactory(StreamFactoryInterface $streamFactory): self;
}
