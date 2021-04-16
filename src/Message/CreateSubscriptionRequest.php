<?php

namespace Omnipay\eProcessingNetwork\Request;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Helpers\Schedule;
use Psr\Http\Message\ResponseInterface;

class CreateSubscriptionRequest extends AbstractRequest
{
    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    protected string $requestType = 'transaction';
    protected string $tranType = 'sale';

    public function getData(): array
    {
        if ($this->getTestMode()) {
            // todo do something here to ensure a test card will be sent
        }

        return [
            'RequestType' => $this->requestType,
            'TranType' => $this->tranType,
            'Total' => $this->getTotal(),
            'Address' => trim($this->getCard()->getBillingAddress1().' '.$this->getCard()->getBillingAddress2()),
            'Zip' => $this->getCard()->getBillingPostcode(),
            'CardNo' => $this->getCard()->getNumber(),
            'ExpMonth' => $this->getCard()->getExpiryMonth(),
            'ExpYear' => $this->getCard()->getExpiryYear(),
            'CVV2Type' => '1',
            'CVV2' => $this->getCard()->getCvv(),
            'RecurMethodID' => '0', // Submit the value "0" to indicate you are creating a recurring transaction on the fly
            'Identifier' => $this->getName(),
            'RCRRecurAmount' => $this->getTotal(),
            'RCRRecurs' => $this->getSchedule()->getOccurrences(),
            'RCRChargeWhen' => 'OnDayOfCycle',
            'RCRPeriod' => $this->getSchedule()->getInterval(),
            'RCRStartOnDay' => $this->getSchedule()->getStartDate()->format('m~d~Y'),
        ];
    }

    /**
     * Get the subscription plan name.
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getParameter('subscriptionName');
    }

    /**
     * Set the subscription plan name.
     *
     * @param string $subscriptionName
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setName(string $subscriptionName): RequestInterface
    {
        return $this->setParameter('subscriptionName', $subscriptionName);
    }

    /**
     * Get the subscription total.
     *
     * @return string|null
     */
    public function getTotal(): ?string
    {
        return $this->getParameter('subscriptionTotal');
    }

    /**
     * Set the subscription total.
     *
     * @param string $subscriptionTotal
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setTotal(string $subscriptionTotal): RequestInterface
    {
        return $this->setParameter('subscriptionTotal', $subscriptionTotal);
    }

    /**
     * Get the subscription schedule.
     *
     * @return \Omnipay\eProcessingNetwork\Helpers\Schedule|null
     */
    public function getSchedule(): ?Schedule
    {
        return $this->getParameter('schedule');
    }

    /**
     * Set the subscription schedule.
     *
     * @param \Omnipay\eProcessingNetwork\Helpers\Schedule $schedule
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setSchedule(Schedule $schedule): RequestInterface
    {
        return $this->setParameter('schedule', $schedule);
    }
}
