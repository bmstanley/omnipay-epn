<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;

class UpdateCardRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/recur.pl';
    protected string $requestType = 'recur';
    protected string $tranType = 'ModifyCreditCard';

    public function getData(): array
    {
        return [
            'RequestType' => $this->requestType,
            'TranType' => $this->tranType,
            'CardNo' => $this->getCard()->getNumber(),
            'ExpMonth' => $this->getCard()->getExpiryMonth(),
            'ExpYear' => $this->getCard()->getExpiryYear(),
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
            'RecurID' => $this->getSubscriptionId(),
        ];
    }

    /**
     * Get the subscription plan name.
     *
     * @return string|null
     */
    public function getSubscriptionId(): ?string
    {
        return $this->getParameter('subscriptionId');
    }

    /**
     * Set the subscription ID.
     *
     * @param string $subscriptionId
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setSubscriptionId(string $subscriptionId): RequestInterface
    {
        return $this->setParameter('subscriptionId', $subscriptionId);
    }
}
