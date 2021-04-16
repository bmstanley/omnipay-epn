<?php
namespace Omnipay\CreditCardPaymentProcessor;

use Omnipay\Tests\GatewayTestCase;

class RecurringGatewayTest extends GatewayTestCase
{
    /** @var RecurringGateway */
    protected $gateway;

    public function setUp(): void
    {
        parent::setUp();

        $this->gateway = new RecurringGateway($this->getHttpClient(), $this->getHttpRequest());

        $this->gateway->setAccountNumber('merchant_123')->setKey('secret_test');
    }

    protected function tearDown(): void
    {
        $this->gateway = null;
    }
}
