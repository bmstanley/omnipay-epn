<?php
namespace Omnipay\CreditCardPaymentProcessor;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\ePaymentProcessor\AbstractGateway;
use Omnipay\eProcessingNetwork\Request\CreateSubscriptionRequest;

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
}
