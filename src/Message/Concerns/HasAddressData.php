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
            'Address' => trim($this->getAddress1() . ' ' . $this->getAddress2()),
            'Zip' => $this->getPostcode(),
        ];
    }
}
