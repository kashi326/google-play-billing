<?php

namespace Kashi326\GooglePlay\ValueObjects;

use Psr\Http\Message\ResponseInterface;

/**
 * Empty response class.
 */
final class EmptyResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }
}
