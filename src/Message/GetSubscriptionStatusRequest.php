<?php

namespace Omnipay\eProcessingNetwork\Message;

class GetSubscriptionStatusRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/status.pl';
    protected string $requestType = 'status';

    public function getData(): array
    {
        return [
            'RequestType' => $this->requestType,
            'Tran_token' => $this->getTransactionReference(),
        ];
    }
}
