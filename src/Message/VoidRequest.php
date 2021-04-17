<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;

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
