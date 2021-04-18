<?php

namespace Omnipay\eProcessingNetwork\Message\Concerns;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Helpers\Schedule;

trait HasSubscriptionData
{
    /**
     * Get the subscription plan name.
     *
     * @return string|null
     */
    public function getSubscriptionId(): ?string
    {
        return $this->getParameter('subscriptionId');
    }

    /**
     * Set the subscription ID.
     *
     * @param string $subscriptionId
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setSubscriptionId(string $subscriptionId): RequestInterface
    {
        return $this->setParameter('subscriptionId', $subscriptionId);
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
     * Get the subscription plan name.
     *
     * @return string|null
     */
    public function getRecurringAmount(): ?string
    {
        return $this->getParameter('recurringAmount');
    }

    /**
     * Set the subscription plan name.
     *
     * @param string $recurringAmount
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function setRecurringAmount(string $recurringAmount): RequestInterface
    {
        return $this->setParameter('recurringAmount', $recurringAmount);
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
