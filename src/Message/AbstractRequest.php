<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Psr\Http\Message\ResponseInterface;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @throws \JsonException
     */
    protected function sendRequest($data, $method = 'POST'): ResponseInterface
    {
        return $this->httpClient->request(
            $method,
            $this->url,
            ['Content-Type' => 'application/json'],
            json_encode($data)
        );
    }

    /**
     * @throws \JsonException
     */
    public function sendData($data): \Omnipay\Common\Message\ResponseInterface
    {
        $response = $this->sendRequest($data);
        $body = (string)($response->getBody());
        return new Response($this, json_decode($body, true));
    }

    public function getAccount()
    {
        return $this->getParameter('ePNAccount');
    }

    public function getKey()
    {
        return $this->getParameter('RestrictKey');
    }
}
