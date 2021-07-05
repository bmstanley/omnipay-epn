<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;

class PurchaseRequest extends AbstractRequest
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
    protected $tranType = 'Sale';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount');

        if ($this->getParameter('card')) {
            $this->validate('card');
            $paymentMethod = $this->getCreditCardTransactionData();
        } else {
            $this->validate('token', 'billingAddress1', 'billingPostcode');
            // the "token" should be a previously successful XactID
            // from calling $response->getTransactionId()
            $paymentMethod = ['TransID' => $this->getToken()];
        }

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'TranType' => $this->tranType,
                'Total' => $this->getAmount(),
            ],
            $this->getAddressData(),
            $paymentMethod
        );
    }
}
