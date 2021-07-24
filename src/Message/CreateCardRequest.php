<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCustomerData;

class CreateCardRequest extends AbstractRequest
{
    use HasCreditCardData;
    use HasCustomerData;

    /**
     * @var string
     */
    protected $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/cdm.pl';
    /**
     * @var string
     */
    protected $requestType = 'cdm';
    /**
     * @var string
     */
    protected $action = 'AddPayment';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('card', 'customerId');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'CustomerID' => $this->getCustomerId(),
                'Action' => $this->action,
                'RecordType' => 'C',
            ],
            $this->getCreditCardRegistrationData()
        );
    }

    public function getTestResponseData(): array
    {
        return [
            'status' => 1,
            'refId' => '',
            'pageCount' => 1,
            'action' => 'List',
            'result' => [
                [
                    'CustomerType' => 'P',
                    'AddressID' => '1',
                    'RecordType' => 'C',
                    'PaymentID' => '113',
                    'ExpireMonth' => '03',
                    'BillingAddress' => null,
                    'CustomerID' => 8,
                    'CardType' => 'Visa',
                    'LastFour' => '1111',
                    'ExpireYear' => '24',
                    'XactID' => '20210724101607-0421161-345',
                ],
            ],
            'resultCount' => 1,
            'currentPage' => 1,
        ];
    }
}
