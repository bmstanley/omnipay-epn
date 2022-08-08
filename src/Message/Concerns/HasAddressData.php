<?php

namespace Omnipay\eProcessingNetwork\Message\Concerns;

use Omnipay\Common\Message\RequestInterface;

trait HasAddressData
{
    /**
     * The standard data set for submitting a customer address
     *
     * @return array
     */
    protected function getAddressData(): array
    {
        return [
            'Address' => trim($this->getAddress1() . ' ' . $this->getAddress2()),
            'Zip' => $this->getPostcode(),
        ];
    }

    /**
     * Get the customer's billing address 1
     *
     * @return string|null
     */
    public function getAddress1(): ?string
    {
        if ($this->getCard()) {
            return $this->getCard()->getBillingAddress1();
        }

        return $this->getParameter('billingAddress1');
    }

    /**
     * Set the customer's billing address 1
     *
     * @param string $billingAddress1
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setAddress1(string $billingAddress1): RequestInterface
    {
        return $this->setParameter('billingAddress1', $billingAddress1);
    }

    /**
     * Get the customer's billing address 2
     *
     * @return string|null
     */
    public function getAddress2(): ?string
    {
        if ($this->getCard()) {
            return $this->getCard()->getBillingAddress2();
        }

        return $this->getParameter('billingAddress2');
    }

    /**
     * Set the customer's billing address 2
     *
     * @param string $billingAddress2
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setAddress2(string $billingAddress2): RequestInterface
    {
        return $this->setParameter('billingAddress2', $billingAddress2);
    }

    /**
     * Get the customer's billing postal/zip code
     *
     * @return string|null
     */
    public function getPostcode(): ?string
    {
        if ($this->getCard()) {
            return $this->getCard()->getPostcode();
        }

        return $this->getParameter('billingPostcode');
    }

    /**
     * Set the customer's billing postal/zip code
     *
     * @param string $billingPostcode
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setPostcode(string $billingPostcode): RequestInterface
    {
        return $this->setParameter('billingPostcode', $billingPostcode);
    }
}
