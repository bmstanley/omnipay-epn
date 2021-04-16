<?php

namespace Omnipay\eProcessingNetwork\Request;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    protected string $url;

    /**
     * @throws \JsonException
     */
    protected function sendRequest($data, $method = 'POST'): ResponseInterface
    {
        return $this->httpClient->request(
            $method,
            $this->url,
            ['Content-Type' => 'application/json'],
            json_encode($data, JSON_THROW_ON_ERROR)
        );
    }

    /**
     * @throws \JsonException
     */
    public function sendData($data): \Omnipay\Common\Message\ResponseInterface
    {
        $response = $this->sendRequest($data);
        $body = (string)($response->getBody());
        return new Response($this, json_decode($body, true, 512, JSON_THROW_ON_ERROR));
    }
}
