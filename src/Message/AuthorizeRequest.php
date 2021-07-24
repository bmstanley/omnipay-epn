<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;

class AuthorizeRequest extends AbstractRequest
{
    use HasAddressData;
    use HasCreditCardData;

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
    protected $tranType = 'AuthOnly';

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
            $this->getCreditCardTransactionData()
        );
    }

    public function getTestResponseData(): array
    {
        $amount = (float)$this->getAmount();
        if ($amount === 2.01) {
            return [
                'CVV2Text' => 'CVV2 Match (M)',
                'AVSText' => 'AVS Match 9 Digit Zip and Address (X)',
                'CVV2Code' => 'M',
                'RespText' => 'DECLINED',
                'Tran_token' => 'DFDDFE7E-6C69-1014-9E9F-F42C44BE5CE2',
                'Success' => 'N',
                'XactID' => '20210502073456-1234567-12-0',
                'Invoice' => '12',
                'AVSCode' => 'X',
            ];
        }

        if ($amount === 2.011) {
            return [
                'APIStatus' => '400 Bad Request',
                'Success' => 'U',
                'RespText' => 'Invalid Total Amount. Error (007)',
            ];
        }

        return [
            'AVSText' => 'AVS Match 9 Digit Zip and Address (X)',
            'CVV2Code' => 'M',
            'AVSCode' => 'X',
            'Invoice' => '11',
            'XactID' => '20210502072836-1234567-11',
            'Tran_token' => 'A886E4D0-6C69-1014-9F14-E3436113A1D0',
            'Success' => 'Y',
            'RespText' => 'APPROVED 311004',
            'CVV2Text' => 'CVV2 Match (M)',
            'AuthCode' => '3110044',
        ];
    }
}
