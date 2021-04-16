<?php

namespace Omnipay\eProcessingNetwork;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\CancelSubscriptionRequest;
use Omnipay\eProcessingNetwork\Message\CreateSubscriptionRequest;
use Omnipay\eProcessingNetwork\Message\GetSubscriptionStatusRequest;
use Omnipay\eProcessingNetwork\Message\UpdateCardRequest;

/**
 * eProcessingNetwork Driver for Omnipay
 *
 * This driver is based on
 * eProcessingNetwork TDBE API documentation
 *
 * @link https://www.eprocessingnetwork.com/tdbe_doc.html
 */
class RecurringGateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'eProcessingNetwork TDBE API Recurring Payments Gateway';
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function createSubscription(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            CreateSubscriptionRequest::class,
            $parameters
        );
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function cancelSubscription(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            CancelSubscriptionRequest::class,
            $parameters
        );
    }

    /**
     * @param array $parameters
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function getSubscription(array $parameters = []): RequestInterface
    {
        return $this->createRequest(
            GetSubscriptionStatusRequest::class,
            $parameters
        );
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function updateCard(array $options = []): RequestInterface
    {
        return $this->createRequest(
            UpdateCardRequest::class,
            $options
        );
    }
}
