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
        $month = str_pad(substr($this->getCard()->getExpiryMonth(), -2, 2), 2, '0', STR_PAD_LEFT);
        $year = substr($this->getCard()->getExpiryYear(), -2, 2);

        return [
            'CardNo' => $this->getCard()->getNumber(),
            'CardNumber' => $this->getCard()->getNumber(),
            'CardType' => $this->getCard()->getBrand(),
            'ExpMonth' => $month,
            'ExpireMonth' => $month,
            'ExpYear' => $year,
            'ExpireYear' => $year,
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
        ];
    }
}
