<?php

namespace Omnipay\eProcessingNetwork\Message;

class VoidRequest extends AbstractRequest
{
    /**
     * @var string
     */
    protected $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    /**
     * @var string
     */
    protected $requestType = 'transaction';
    /**
     * @var string
     */
    protected $tranType = 'Void';

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
