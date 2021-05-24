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
    protected function getCreditCardTransactionData(): array
    {
        return [
            'CardNo' => $this->getCard()->getNumber(),
            'ExpMonth' => $this->getCardMonth(),
            'ExpYear' => $this->getCardYear(),
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
        ];
    }

    public function getCreditCardRegistrationData(): array
    {
        return [
            'CardNumber' => $this->getCard()->getNumber(),
            'CardType' => $this->getCard()->getBrand(),
            'ExpireMonth' => $this->getCardMonth(),
            'ExpireYear' => $this->getCardYear(),
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
        ];
    }

    protected function getCardMonth(): string
    {
        return str_pad(substr($this->getCard()->getExpiryMonth(), -2, 2), 2, '0', STR_PAD_LEFT);
    }

    protected function getCardYear(): string
    {
        return substr($this->getCard()->getExpiryYear(), -2, 2);
    }
}
