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
                // the 'token' should be a previously successful XactID
                // from calling $response->getTransactionId()
                'TransID' => $this->getToken(),
            ],
            $this->getAddressData()
        );
    }

    public function getTestResponseData(): array
    {
        $amount = (float)$this->getAmount();
        if ($amount === 2.01 || $amount === 2.011) {
            return [
                'APIStatus' => '400 Bad Request',
                'Success' => 'U',
                'RespText' => 'Invalid Total Amount. Error (007)',
            ];
        }

        return [
            'Tran_token' => '3DD64D1B-6D33-1014-AB53-F17CE165EBBB',
            'RespText' => 'SUCCESSFUL',
            'XactID' => '20210724102752-0421161-343',
            'Invoice' => '343',
            'Success' => 'Y'
        ];
    }
}
