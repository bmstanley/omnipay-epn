<?php

namespace Omnipay\ePaymentProcessor;

use Omnipay\Common\AbstractGateway as OmniAbstractGateway;
use Omnipay\Common\GatewayInterface;

abstract class AbstractGateway extends OmniAbstractGateway
{
    public function getDefaultParameters(): array
    {
        return [
            'ePNAccount' => null,
            'RestrictKey' => null,
            'RequestType' => null,
        ];
    }

    /**
     * Get the merchant's eProcessingNetwork account number.
     *
     * @return string|null
     */
    public function getAccountNumber(): ?string
    {
        return $this->getParameter('ePNAccount');
    }

    /**
     * Set the merchant's eProcessingNetwork account number.
     *
     * @param string $ePNAccount
     * @return \Omnipay\Common\GatewayInterface
     */
    public function setAccountNumber(string $ePNAccount): GatewayInterface
    {
        return $this->setParameter('ePNAccount', $ePNAccount);
    }

    /**
     * Get the merchant's secure code
     *
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->getParameter('RestrictKey');
    }

    /**
     * Set the merchant's secure code
     *
     * @param string $restrictKey
     * @return \Omnipay\Common\GatewayInterface
     */
    public function setKey(string $restrictKey): GatewayInterface
    {
        return $this->setParameter('RestrictKey', $restrictKey);
    }

    /**
     * Get the request type
     *
     * @return string|null
     */
    public function getRequestType(): ?string
    {
        return $this->getParameter('RequestType');
    }

    /**
     * Set the request type
     *
     * @param string $requestType
     * @return \Omnipay\Common\GatewayInterface
     */
    public function setRequestType(string $requestType): GatewayInterface
    {
        return $this->setParameter('RequestType', $requestType);
    }
}
