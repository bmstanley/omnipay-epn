<?php

namespace Omnipay\eProcessingNetwork\Message\Concerns;

trait HasCreditCardData
{
    /**
     * The standard data set submitting a credit card
     *
     * @return array
     */
    protected function getCreditCardData(): array
    {
        return [
            'Zip' => $this->getCard()->getBillingPostcode(),
            'CardNo' => $this->getCard()->getNumber(),
            'ExpMonth' => $this->getCard()->getExpiryMonth(),
            'ExpYear' => $this->getCard()->getExpiryYear(),
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
        ];
    }
}
