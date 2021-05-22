<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCustomerData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasSubscriptionData;

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
}
