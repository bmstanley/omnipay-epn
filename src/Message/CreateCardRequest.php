<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCustomerData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasSubscriptionData;

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
                'Action' => $this->action,
                'CustomerID' => $this->getCustomerId(),
            ],
            $this->getCreditCardData()
        );
    }
}
