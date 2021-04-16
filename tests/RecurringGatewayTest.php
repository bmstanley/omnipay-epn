<?php
namespace Omnipay\CreditCardPaymentProcessor;

use Omnipay\eProcessingNetwork\Message\CreateSubscriptionRequest;
use Omnipay\eProcessingNetwork\RecurringGateway;
use Omnipay\Tests\GatewayTestCase;

class RecurringGatewayTest extends GatewayTestCase
{
    /** @var \Omnipay\eProcessingNetwork\RecurringGateway */
    protected $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new RecurringGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setAccountNumber(getenv('EPN_ACCOUNT'))->setKey(getenv('RESTRICT_KEY'));
    }

    public function testCreateSubscription(): void
    {
        $request = $this->gateway->createSubscription(['amount' => '10.00']);

        self::assertInstanceOf(CreateSubscriptionRequest::class, $request);
        self::assertSame('10.00', $request->getAmount());
    }
}
