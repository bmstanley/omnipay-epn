<?php

namespace Omnipay\eProcessingNetwork\Tests\Message;

use Omnipay\eProcessingNetwork\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var \Omnipay\eProcessingNetwork\Message\PurchaseRequest
     */
    private $creditCardRequest;
    /**
     * @var \Omnipay\eProcessingNetwork\Message\PurchaseRequest
     */
    private $tokenRequest;

    public function setUp(): void
    {
        $this->creditCardRequest = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->creditCardRequest->initialize(
            [
                'amount' => '10.00',
                'card' => $this->getValidCard(),
            ]
        );

        $this->tokenRequest = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->tokenRequest->initialize(
            [
                'amount' => '10.00',
                'token' => '20210502072836-1234567-11',
                'address1' => '123 Main St',
                'postcode' => '55555',
            ]
        );
    }

    public function test_send_success_with_card(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->creditCardRequest->send();

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('20210502072836-1234567-11', $response->getTransactionId());
        self::assertSame('APPROVED 311004', $response->getMessage());
    }

    public function test_send_declined_with_card(): void
    {
        $this->setMockHttpResponse('PurchaseDeclined.txt');
        $response = $this->creditCardRequest->send();

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('20210502073456-1234567-12-0', $response->getTransactionId());
        self::assertSame('DECLINED', $response->getMessage());
    }

    public function test_send_unable_to_process_with_card(): void
    {
        $this->setMockHttpResponse('PurchaseUnableToProcess.txt');
        $response = $this->creditCardRequest->send();

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertNull($response->getTransactionId());
        self::assertSame('Invalid Total Amount. Error (007)', $response->getMessage());
    }

    public function test_send_success_with_token(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->tokenRequest->send();

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('20210502072836-1234567-11', $response->getTransactionId());
        self::assertSame('APPROVED 311004', $response->getMessage());
    }

    public function test_send_declined_with_token(): void
    {
        $this->setMockHttpResponse('PurchaseDeclined.txt');
        $response = $this->tokenRequest->send();

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('20210502073456-1234567-12-0', $response->getTransactionId());
        self::assertSame('DECLINED', $response->getMessage());
    }

    public function test_send_unable_to_process_with_token(): void
    {
        $this->setMockHttpResponse('PurchaseUnableToProcess.txt');
        $response = $this->tokenRequest->send();

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertNull($response->getTransactionId());
        self::assertSame('Invalid Total Amount. Error (007)', $response->getMessage());
    }
}
