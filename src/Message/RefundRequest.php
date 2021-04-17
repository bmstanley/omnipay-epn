<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\CreditCard;

class RefundRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    protected string $requestType = 'transaction';
    protected string $tranType = 'Return';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        if ($this->getCard() instanceof CreditCard) {
            $this->validate('card');

            $key = 'CardNo';
            $value = $this->getCard()->getNumber();
        } else {
            $this->validate('transactionReference');

            $key = 'XactID';
            $value = $this->getTransactionReference();
        }

        return [
            'RequestType' => $this->requestType,
            'TranType' => $this->tranType,
            $key => $value,
        ];
    }
}
