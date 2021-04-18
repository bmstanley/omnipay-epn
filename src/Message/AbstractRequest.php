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

    protected function sendRequest($data, $method = 'POST'): ResponseInterface
    {
        $data = array_merge($data ?? [], $this->getAuthData());
        return $this->httpClient->request(
            $method,
            $this->url,
            ['Content-Type' => 'application/json'],
            json_encode($data)
        );
    }

    public function sendData($data): \Omnipay\Common\Message\ResponseInterface
    {
        $response = $this->sendRequest($data);
        $body = (string)($response->getBody());
        return new Response($this, json_decode($body, true));
    }

    public function getAuthData(): array
    {
        return [
            'ePNAccount' => $this->getParameter('accountNumber'),
            'RestrictKey' => $this->getParameter('restrictKey'),
        ];
    }
}
