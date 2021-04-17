<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasSubscriptionData;

class CancelSubscriptionRequest extends AbstractRequest
{
    use HasSubscriptionData;

    /**
     * @var string
     */
    protected $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/recur.pl';
    /**
     * @var string
     */
    protected $requestType = 'recur';
    /**
     * @var string
     */
    protected $tranType = 'Cancel';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('subscriptionId');

        return [
            'RequestType' => $this->requestType,
            'TranType' => $this->tranType,
            'RecurID' => $this->getSubscriptionId(),
        ];
    }
}
