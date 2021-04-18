<?php

namespace Omnipay\eProcessingNetwork;

use Omnipay\Common\AbstractGateway as OmniAbstractGateway;
use Omnipay\Common\GatewayInterface;

abstract class AbstractGateway extends OmniAbstractGateway
{
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
}
