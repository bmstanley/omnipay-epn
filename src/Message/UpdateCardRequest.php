<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasSubscriptionData;

class UpdateCardRequest extends AbstractRequest
{
    use HasCreditCardData;
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
    protected $tranType = 'ModifyCreditCard';

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
}
