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

    public function getTestResponseData(): array
    {
        $amount = (float)$this->getAmount();
        if ($amount === 2.01) {
            return [
                'CVV2Text' => 'CVV2 Match (M)',
                'AVSText' => 'AVS Match 9 Digit Zip and Address (X)',
                'CVV2Code' => 'M',
                'RespText' => 'DECLINED',
                'Tran_token' => 'DFDDFE7E-6C69-1014-9E9F-F42C44BE5CE2',
                'Success' => 'N',
                'XactID' => '20210502073456-1234567-12-0',
                'Invoice' => '12',
                'AVSCode' => 'X',
            ];
        }

        if ($amount === 2.011) {
            return [
                'APIStatus' => '400 Bad Request',
                'Success' => 'U',
                'RespText' => 'Invalid Total Amount. Error (007)',
            ];
        }

        return [
            'AVSText' => 'AVS Match 9 Digit Zip and Address (X)',
            'CVV2Code' => 'M',
            'AVSCode' => 'X',
            'Invoice' => '11',
            'XactID' => '20210502072836-1234567-11',
            'Tran_token' => 'A886E4D0-6C69-1014-9F14-E3436113A1D0',
            'Success' => 'Y',
            'RespText' => 'APPROVED 311004',
            'CVV2Text' => 'CVV2 Match (M)',
            'AuthCode' => '3110044',
        ];
    }
}
