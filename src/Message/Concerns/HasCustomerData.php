<?php

namespace Omnipay\eProcessingNetwork\Message\Concerns;

use Omnipay\Common\Message\RequestInterface;

trait HasCustomerData
{
    /**
     * The standard data set for submitting a customer address
     *
     * @return array
     */
    protected function getCustomerData(): array
    {
        return [
            'Name' => $this->getCustomerName(),
            'Phone' => $this->getCustomerPhone(),
            'Email' => $this->getCustomerEmail(),
            'Identifier' => $this->getCustomerLocalIdentifier(),
        ];
    }

    /**
     * Get the request's customer ID.
     *
     * @return string|null
     */
    public function getCustomerId(): ?string
    {
        return $this->getParameter('customerId');
    }

    /**
     * Set the request's customer ID.
     *
     * @param string $customerId
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setCustomerId(string $customerId): RequestInterface
    {
        return $this->setParameter('customerId', $customerId);
    }

    /**
     * Get the request's customer name.
     *
     * @return string|null
     */
    public function getCustomerName(): ?string
    {
        return $this->getParameter('customerName');
    }

    /**
     * Set the request's customer name.
     *
     * @param string $customerName
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setCustomerName(string $customerName): RequestInterface
    {
        return $this->setParameter('customerName', $customerName);
    }

    /**
     * Get the request's customer phone.
     *
     * @return string|null
     */
    public function getCustomerPhone(): ?string
    {
        return $this->getParameter('customerPhone');
    }

    /**
     * Set the request's customer phone.
     *
     * @param string $customerPhone
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setCustomerPhone(string $customerPhone): RequestInterface
    {
        return $this->setParameter('customerPhone', $customerPhone);
    }

    /**
     * Get the request's customer email.
     *
     * @return string|null
     */
    public function getCustomerEmail(): ?string
    {
        return $this->getParameter('customerEmail');
    }

    /**
     * Set the request's customer email.
     *
     * @param string $customerEmail
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setCustomerEmail(string $customerEmail): RequestInterface
    {
        return $this->setParameter('customerEmail', $customerEmail);
    }

    /**
     * Get the request's customer local identifier.
     *
     * @return string|null
     */
    public function getCustomerLocalIdentifier(): ?string
    {
        return $this->getParameter('customerLocalIdentifier');
    }

    /**
     * Set the request's customer local identifier.
     *
     * @param string $customerLocalIdentifier
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setCustomerLocalIdentifier(string $customerLocalIdentifier): RequestInterface
    {
        return $this->setParameter('customerLocalIdentifier', $customerLocalIdentifier);
    }
}
