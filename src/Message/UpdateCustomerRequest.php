<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasCustomerData;

class UpdateCustomerRequest extends AbstractRequest
{
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
    protected $action = 'ModifyCustomer';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('customerId', 'customerName', 'customerPhone', 'customerEmail', 'customerLocalIdentifier');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'Action' => $this->action,
                'CustomerID' => $this->getCustomerId(),
            ],
            $this->getCustomerData()
        );
    }

    public function getTestResponseData(): array
    {
        return [
            'status' => 1,
            'currentPage' => 1,
            'refId' => '',
            'result' => [
                [
                    'DefaultPayment' => 'Visa x1111',
                    'Payments' => [
                        [
                            'ExpireYear' => '24',
                            'ExpireMonth' => '03',
                            'XactID' => '20210724101607-0421161-345',
                            'CardType' => 'Visa',
                            'AddressID' => '1',
                            'CustomerID' => 100,
                            'PaymentID' => '113',
                            'LastFour' => '1111',
                            'BillingAddress' => null,
                            'RecordType' => 'C',
                            'CustomerType' => 'P',
                        ],
                    ],
                    'Description' => '',
                    'Phone' => '555-555-5855',
                    'CustomerID' => '100',
                    'Identifier' => 'ABC-123',
                    'Email' => 'yfoster@email.com',
                    'RecordType' => 'Customer',
                    'Name' => 'Yvonne Foster',
                    'DefaultPaymentID' => '113',
                ],
            ],
            'action' => 'List',
            'resultCount' => 1,
            'pageCount' => 1,
        ];
    }
}
