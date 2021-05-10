<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;

class PurchaseRequest extends AbstractRequest
{
    use HasAddressData;
    use HasCreditCardData;

    /**
     * @var string
     */
    protected $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    /**
     * @var string
     */
    protected $requestType = 'transaction';
    /**
     * @var string
     */
    protected $tranType = 'Sale';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount');

        if ($this->getParameter('card')) {
            $this->validate('card');
            $paymentMethod = $this->getCreditCardData();
        } else {
            $this->validate('token', 'billingAddress1', 'billingPostcode');
            // the "token" should be a previously successful XactID
            // from calling $response->getTransactionId()
            $paymentMethod = ['TransID' => $this->getToken()];
        }

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'TranType' => $this->tranType,
                'Total' => $this->getAmount(),
            ],
            $this->getAddressData(),
            $paymentMethod
        );
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
