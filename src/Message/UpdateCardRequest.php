<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCustomerData;

class UpdateCardRequest extends AbstractRequest
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
    protected $action = 'ModifyPayment';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('card', 'customerId', 'paymentId');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'CustomerID' => $this->getCustomerId(),
                'PaymentID' => $this->getPaymentId(),
                'Action' => $this->action,
                'RecordType' => 'C',
            ],
            $this->getCreditCardRegistrationData()
        );
    }

    public function getTestResponseData(): array
    {
        return [
            'action' => 'List',
            'pageCount' => 1,
            'currentPage' => 1,
            'status' => 1,
            'refId' => '',
            'resultCount' => 1,
            'result' => [
                [
                    'RecordType' => 'C',
                    'CardType' => 'Visa',
                    'CustomerID' => 99,
                    'AddressID' => '',
                    'XactID' => '20210705091537-0421161-341',
                    'PaymentID' => '111',
                    'ExpireYear' => '26',
                    'ExpireMonth' => '03',
                    'LastFour' => '0000',
                    'CustomerType' => 'P',
                    'BillingAddress' => '',
                ],
            ],
        ];
    }
}
