<?php

namespace Omnipay\eProcessingNetwork\Message;

class GetSubscriptionStatusRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/status.pl';
    /**
     * @var string
     */
    protected $requestType = 'status';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionId');

        return [
            'RequestType' => $this->requestType,
            'Tran_token' => $this->getTransactionId(),
        ];
    }
}
