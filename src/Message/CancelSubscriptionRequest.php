<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;

class CancelSubscriptionRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/recur.pl';
    protected string $requestType = 'recur';
    protected string $tranType = 'Cancel';

    public function getData(): array
    {
        return [
            'RequestType' => $this->requestType,
            'TranType' => $this->tranType,
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
