<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;

class AuthorizeRequest extends AbstractRequest
{
    use HasAddressData;
    use HasCreditCardData;

    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    protected string $requestType = 'transaction';
    protected string $tranType = 'AuthOnly';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'card');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'TranType' => $this->tranType,
                'Total' => $this->getAmount(),
            ],
            $this->getAddressData(),
            $this->getCreditCardData()
        );
    }
}
