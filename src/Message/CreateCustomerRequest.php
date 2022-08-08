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
                    'Phone' => $this->getCustomerPhone(),
                    'Addresses' => [],
                    'Name' => $this->getCustomerName(),
                    'DefaultPaymentID' => '',
                    'Description' => '',
                    'DefaultPayment' => 'None',
                    'Identifier' => $this->getCustomerLocalIdentifier(),
                    'CustomerID' => '100',
                    'Email' => $this->getCustomerEmail(),
                    'RecordType' => 'Customer',
                ],
            ],
            'pageCount' => 1,
            'currentPage' => 1,
            'status' => 1,
        ];
    }
}
