<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;

class UpdateCardRequest extends AbstractRequest
{
    use HasCreditCardData;

    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/recur.pl';
    protected string $requestType = 'recur';
    protected string $tranType = 'ModifyCreditCard';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('card', 'subscriptionId');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'TranType' => $this->tranType,
            ],
            $this->getCreditCardData(),
            [
                'RecurID' => $this->getSubscriptionId(),
            ]
        );
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
