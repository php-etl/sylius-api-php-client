<?php

namespace Diglin\Sylius\ApiClient\Routing;

/**
 * Generate a complete uri from a base path, uri parameters, and query parameters.
 *
 * @author    Laurent Petard <laurent.petard@akeneo.com>
 * @copyright 2017 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class UriGenerator implements UriGeneratorInterface
{
    /** @var string */
    protected $baseUri;

    /**
     * @param string $baseUri Base URI of the API
     */
    public function __construct($baseUri)
    {
        $this->baseUri = rtrim($baseUri, '/');
    }

    /**
     * {@inheritdoc}
     */
    public function generate(string|\Stringable $path, array $uriParameters = [], array $queryParameters = [])
    {
        $uriParameters = $this->encodeUriParameters($uriParameters);

        $uri = $this->baseUri.'/'.sprintf(ltrim((string) $path, '/'), ...$uriParameters);

        $queryParameters = $this->booleanQueryParametersAsString($queryParameters);

        if (!empty($queryParameters)) {
            $uri .= '?'.http_build_query($queryParameters, "", '&', PHP_QUERY_RFC3986);
        }

        return $uri;
    }

    /**
     * Transforms boolean query parameters as string 'true' or 'false' instead of 0 or 1.
     *
     * @return array
     */
    protected function booleanQueryParametersAsString(array $queryParameters)
    {
        return array_map(function ($queryParameters) {
            if (!is_bool($queryParameters)) {
                return $queryParameters;
            }

            return true === $queryParameters ? 'true' : 'false';
        }, $queryParameters);
    }

    /**
     * Slash character should not be url encoded because it is not allowed
     * by the webservers for security reasons.
     *
     * This character can be used by product identifier and media code.
     *
     * @return array
     */
    protected function encodeUriParameters(array $uriParameters)
    {
        return array_map(function ($uriParameter) {
            $uriParameter = rawurlencode($uriParameter);

            return preg_replace('~\%2F~', '/', $uriParameter);
        }, $uriParameters);
    }
}
