<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\eProcessingNetwork\Message\Concerns\HasCustomerData;

class CreateCustomerRequest extends AbstractRequest
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
    protected $action = 'AddCustomer';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('customerName', 'customerPhone', 'customerEmail', 'customerLocalIdentifier');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'Action' => $this->action,
            ],
            $this->getCustomerData()
        );
    }

    public function getTestResponseData(): array
    {
        return [
            'refId' => '',
            'resultCount' => 1,
            'action' => 'List',
            'result' => [
                [
                    'Payments' => [],
                    'Phone' => '555-123-4567',
                    'Addresses' => [],
                    'Name' => 'Tester McTester',
                    'DefaultPaymentID' => '',
                    'Description' => '',
                    'DefaultPayment' => 'None',
                    'Identifier' => 'ABC-1234',
                    'CustomerID' => '8',
                    'Email' => 'tmctester@example.com',
                    'RecordType' => 'Customer',
                ],
            ],
            'pageCount' => 1,
            'currentPage' => 1,
            'status' => 1,
        ];
    }
}
