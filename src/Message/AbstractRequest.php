<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;
use Omnipay\Common\Message\RequestInterface;
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
        if ($this->getTestMode() && method_exists($this, 'getTestResponseData')) {
            return new Response($this, $this->getTestResponseData());
        }

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

    /**
     * Get the merchant's eProcessingNetwork account number.
     *
     * @return string|null
     */
    public function getAccountNumber(): ?string
    {
        return $this->getParameter('accountNumber');
    }

    /**
     * Set the merchant's eProcessingNetwork account number.
     *
     * @param string $accountNumber
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setAccountNumber(string $accountNumber): RequestInterface
    {
        return $this->setParameter('accountNumber', $accountNumber);
    }

    /**
     * Get the merchant's secure code
     *
     * @return string|null
     */
    public function getRestrictKey(): ?string
    {
        return $this->getParameter('restrictKey');
    }

    /**
     * Set the merchant's secure code
     *
     * @param string $restrictKey
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setRestrictKey(string $restrictKey): RequestInterface
    {
        return $this->setParameter('restrictKey', $restrictKey);
    }
}
