<?php
namespace Omnipay\CreditCardPaymentProcessor;

use Omnipay\eProcessingNetwork\Message\AuthorizeRequest;
use Omnipay\eProcessingNetwork\Message\CancelSubscriptionRequest;
use Omnipay\eProcessingNetwork\Message\CaptureRequest;
use Omnipay\eProcessingNetwork\Message\CompleteAuthorizeRequest;
use Omnipay\eProcessingNetwork\Message\CreateSubscriptionRequest;
use Omnipay\eProcessingNetwork\Gateway;
use Omnipay\eProcessingNetwork\Message\GetSubscriptionStatusRequest;
use Omnipay\eProcessingNetwork\Message\PurchaseRequest;
use Omnipay\eProcessingNetwork\Message\RefundRequest;
use Omnipay\eProcessingNetwork\Message\UpdateCardRequest;
use Omnipay\eProcessingNetwork\Message\VoidRequest;
use Omnipay\Tests\GatewayTestCase;

class GatewayTest extends GatewayTestCase
{
    /** @var \Omnipay\eProcessingNetwork\Gateway */
    protected $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setAccountNumber(getenv('EPN_ACCOUNT'))->setKey(getenv('RESTRICT_KEY'));
    }

    public function testAuthorizeReturnsRequest(): void
    {
        $request = $this->gateway->authorize();

        self::assertInstanceOf(AuthorizeRequest::class, $request);
    }

    public function testCancelSubscriptionReturnsRequest(): void
    {
        $request = $this->gateway->cancelSubscription();

        self::assertInstanceOf(CancelSubscriptionRequest::class, $request);
    }

    public function testCaptureReturnsRequest(): void
    {
        $request = $this->gateway->capture();

        self::assertInstanceOf(CaptureRequest::class, $request);
    }

    public function testCompleteAuthorizeRequest(): void
    {
        $request = $this->gateway->completeAuthorize();

        self::assertInstanceOf(CompleteAuthorizeRequest::class, $request);
    }

    public function testCreateSubscriptionRequest(): void
    {
        $request = $this->gateway->createSubscription();

        self::assertInstanceOf(CreateSubscriptionRequest::class, $request);
    }

    public function testGetSubscriptionStatusRequest(): void
    {
        $request = $this->gateway->getSubscriptionStatus();

        self::assertInstanceOf(GetSubscriptionStatusRequest::class, $request);
    }

    public function testPurchaseRequest(): void
    {
        $request = $this->gateway->purchase();

        self::assertInstanceOf(PurchaseRequest::class, $request);
    }

    public function testRefundRequest(): void
    {
        $request = $this->gateway->refund();

        self::assertInstanceOf(RefundRequest::class, $request);
    }

    public function testUpdateCardRequest(): void
    {
        $request = $this->gateway->updateCard();

        self::assertInstanceOf(UpdateCardRequest::class, $request);
    }

    public function testVoidRequest(): void
    {
        $request = $this->gateway->void();

        self::assertInstanceOf(VoidRequest::class, $request);
    }
}
