<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;

class CompleteAuthorizeRequest extends AbstractRequest
{
    use HasAddressData;

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
    protected $tranType = 'Auth2Sale';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('token', 'billingAddress1', 'billingPostcode');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'TranType' => $this->tranType,
                'Total' => $this->getAmount(),
                // the "token" should be a previously successful XactID
                // from calling $response->getTransactionId()
                'TransID' => $this->getToken(),
            ],
            $this->getAddressData()
        );
    }
}
