<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\AbstractResponse as OmnipayAbstractResponse;

class Response extends OmnipayAbstractResponse
{
    public function getMessage(): string
    {
        if ($this->isSuccessful()) {
            return $this->getValue('RespText');
        }

        return $this->getErrorMessage();
    }

    protected function getErrorMessage(): string
    {
        $responseText = $this->getValue('RespText');
        switch ($responseText) {
            case 'Amount Error':
                return 'Invalid charge amount';
            case 'Expired Card':
                return 'The given credit card is expired';
            case 'CVV Mismatch':
                return 'Invalid security code';
        }

        // X and Y AVS Codes are success codes
        if (!in_array($this->getValue('AVSCode'), ['X', 'Y'])) {
            return $this->getValue('AVSText');
        }

        if ($this->getValue('CVV2Code') && $this->getValue('CVV2Code') !== 'M') {
            return $this->getValue('CVV2Text');
        }

        return 'The card was declined';
    }

    /**
     * Gateway Reference
     *
     * @return null|string A reference provided by the gateway to represent this transaction
     */
    public function getTransactionReference(): ?string
    {
        return $this->getValue('Tran_token');
    }

    /**
     * Get the transaction ID as generated by the merchant website.
     *
     * @return string|null
     */
    public function getTransactionId(): ?string
    {
        return $this->getValue('XactID');
    }

    /**
     * Get the invoice ID as generated by the merchant website.
     *
     * @return string
     */
    public function getInvoiceId(): string
    {
        return $this->getValue('Invoice');
    }

    /**
     * Get the recurring ID as generated by the merchant website.
     *
     * @return string
     */
    public function getSubscriptionId(): string
    {
        return $this->getValue('RecurID');
    }

    public function isSuccessful(): bool
    {
        if ($this->getValue('Success')) {
            return strcasecmp($this->getValue('Success'), 'y') === 0;
        }

        if ($this->getValue('status') !== null) {
            return (int)$this->getValue('status') === 1;
        }

        return false;
    }

    /**
     * @param mixed|null $key
     * @return string|null
     */
    protected function getValue(string $key)
    {
        return $this->getData()[$key] ?? null;
    }

    public function getCustomerReference(): ?string
    {
        $result = $this->getValue('result');
        if (empty($this->request) || ! method_exists('getCustomerName', $this->request)) {
            return null;
        }

        foreach ($result as $customer) {
            if (
                $this->request->getCustomerName() === $customer['Name']
                && $this->request->getCustomerEmail() === $customer['Email']
                && $this->request->getCustomerPhone() === $customer['Phone']
                && $this->request->getCustomerLocalIdentifier() === $customer['Identifier']
            ) {
                return $customer['CustomerID'];
            }
        }

        return null;
    }

    public function getPaymentReference(): ?string
    {
        $result = $this->getValue('result');
        if (empty($this->request)) {
            return null;
        }

        $requestedCard = $this->request->getCard();
        foreach ($result as $paymentMethod) {
            if (
                substr($requestedCard->getNumber(), -4, 4) === $paymentMethod['LastFour']
                && strcasecmp($requestedCard->getBrand(), $paymentMethod['CardType']) === 0
                && str_pad($requestedCard->getCardMonth(), 2, '0', STR_PAD_LEFT) === $paymentMethod['ExpireMonth']
                && substr($requestedCard->getCardYear(), -4, 4) === $paymentMethod['ExpireYear']
            ) {
                return $paymentMethod['PaymentID'];
            }
        }

        return null;
    }

    public function getPaymentToken(): ?string
    {
        $result = $this->getValue('result');
        if (empty($this->request)) {
            return null;
        }

        $requestedCard = $this->request->getCard();
        foreach ($result as $paymentMethod) {
            if (
                substr($requestedCard->getNumber(), -4, 4) === $paymentMethod['LastFour']
                && strcasecmp($requestedCard->getBrand(), $paymentMethod['CardType']) === 0
                && str_pad($requestedCard->getCardMonth(), 2, '0', STR_PAD_LEFT) === $paymentMethod['ExpireMonth']
                && substr($requestedCard->getCardYear(), -4, 4) === $paymentMethod['ExpireYear']
            ) {
                return $paymentMethod['XactID'];
            }
        }

        return null;
    }
}
