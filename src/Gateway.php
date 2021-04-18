<?php

namespace Omnipay\eProcessingNetwork;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Message\AuthorizeRequest;
use Omnipay\eProcessingNetwork\Message\CancelSubscriptionRequest;
use Omnipay\eProcessingNetwork\Message\CaptureRequest;
use Omnipay\eProcessingNetwork\Message\CompleteAuthorizeRequest;
use Omnipay\eProcessingNetwork\Message\CreateSubscriptionRequest;
use Omnipay\eProcessingNetwork\Message\GetSubscriptionStatusRequest;
use Omnipay\eProcessingNetwork\Message\PurchaseRequest;
use Omnipay\eProcessingNetwork\Message\RefundRequest;
use Omnipay\eProcessingNetwork\Message\UpdateCardRequest;
use Omnipay\eProcessingNetwork\Message\VoidRequest;

/**
 * eProcessingNetwork Driver for Omnipay
 *
 * This driver is based on
 * eProcessingNetwork TDBE API documentation
 *
 * @link https://www.eprocessingnetwork.com/tdbe_doc.html
 */
class Gateway extends AbstractGateway
{
    public function getName(): string
    {
        return 'eProcessingNetwork TDBE API Gateway';
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function authorize(array $options = []): RequestInterface
    {
        return $this->createRequest(AuthorizeRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function capture(array $options = []): RequestInterface
    {
        return $this->createRequest(CaptureRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function completeAuthorize(array $options = []): RequestInterface
    {
        return $this->createRequest(CompleteAuthorizeRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function purchase(array $options = []): RequestInterface
    {
        return $this->createRequest(PurchaseRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function refund(array $options = []): RequestInterface
    {
        return $this->createRequest(RefundRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function void(array $options = []): RequestInterface
    {
        return $this->createRequest(VoidRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function createSubscription(array $options = []): RequestInterface
    {
        return $this->createRequest(CreateSubscriptionRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function cancelSubscription(array $options = []): RequestInterface
    {
        return $this->createRequest(CancelSubscriptionRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function getSubscriptionStatus(array $options = []): RequestInterface
    {
        return $this->createRequest(GetSubscriptionStatusRequest::class, $this->requestOptions($options));
    }

    /**
     * @param array $options
     * @return \Omnipay\Common\Message\RequestInterface
     */
    public function updateCard(array $options = []): RequestInterface
    {
        return $this->createRequest(UpdateCardRequest::class, $this->requestOptions($options));
    }

    protected function requestOptions(array $options = []): array
    {
        return array_merge(
            [
                'ePNAccount' => $this->getAccountNumber(),
                'RestrictKey' => $this->getRestrictKey(),
            ],
            $options
        );
    }
}
