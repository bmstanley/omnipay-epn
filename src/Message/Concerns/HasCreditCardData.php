<?php

namespace Omnipay\eProcessingNetwork\Message\Concerns;

trait HasCreditCardData
{
    /**
     * The standard data set for submitting a credit card
     *
     * @return array
     * @todo override card number when testing
     */
    protected function getCreditCardData(): array
    {
        return [
            'CardNo' => $this->getCard()->getNumber(),
            'CardNumber' => $this->getCard()->getNumber(),
            'CardType' => $this->getCard()->getBrand(),
            'ExpMonth' => $this->getCard()->getExpiryMonth(),
            'ExpireMonth' => $this->getCard()->getExpiryMonth(),
            'ExpYear' => $this->getCard()->getExpiryYear(),
            'ExpireYear' => $this->getCard()->getExpiryYear(),
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
        ];
    }
}
