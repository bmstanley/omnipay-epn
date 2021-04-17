<?php

namespace Omnipay\eProcessingNetwork\Message;

class VoidRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    protected string $requestType = 'transaction';
    protected string $tranType = 'Void';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('transactionReference');

        return [
            'RequestType' => $this->requestType,
            'TranType' => $this->tranType,
            'XactID' => $this->getTransactionReference(),
        ];
    }
}
