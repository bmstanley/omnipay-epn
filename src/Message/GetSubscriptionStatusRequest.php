<?php

namespace Omnipay\eProcessingNetwork\Message;

class GetSubscriptionStatusRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/status.pl';
    protected string $requestType = 'status';

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
