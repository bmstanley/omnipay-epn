<?php

namespace Omnipay\eProcessingNetwork;

use Omnipay\Common\AbstractGateway as OmniAbstractGateway;
use Omnipay\Common\GatewayInterface;

abstract class AbstractGateway extends OmniAbstractGateway
{
    public function getDefaultParameters(): array
    {
        return [
            'accountNumber' => '',
            'restrictKey' => '',
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
     * @return \Omnipay\Common\GatewayInterface
     */
    public function setAccountNumber(string $accountNumber): GatewayInterface
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
     * @return \Omnipay\Common\GatewayInterface
     */
    public function setRestrictKey(string $restrictKey): GatewayInterface
    {
        return $this->setParameter('restrictKey', $restrictKey);
    }
}
