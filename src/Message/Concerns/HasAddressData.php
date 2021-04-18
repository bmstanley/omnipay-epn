<?php

namespace Omnipay\eProcessingNetwork\Message\Concerns;

trait HasAddressData
{
    /**
     * The standard data set for submitting a customer address
     *
     * @return array
     */
    protected function getAddressData(): array
    {
        return [
            'Address' => trim($this->getCard()->getBillingAddress1() . ' ' . $this->getCard()->getBillingAddress2()),
            'Zip' => $this->getCard()->getBillingPostcode(),
        ];
    }
}
