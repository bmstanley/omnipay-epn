<?php

namespace Omnipay\eProcessingNetwork\Tests\Message;

use Omnipay\eProcessingNetwork\Message\PurchaseRequest;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var \Omnipay\eProcessingNetwork\Message\PurchaseRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            array(
                'amount' => '10.00',
                'card' => $this->getValidCard(),
            )
        );
    }

    public function test_send_success(): void
    {
        $this->setMockHttpResponse('PurchaseSuccess.txt');
        $response = $this->request->send();

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('20210502072836-1234567-11', $response->getTransactionReference());
        self::assertSame('APPROVED 311004', $response->getMessage());
    }

    public function test_send_declined(): void
    {
        $this->setMockHttpResponse('PurchaseDeclined.txt');
        $response = $this->request->send();

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('20210502073456-1234567-12-0', $response->getTransactionReference());
        self::assertSame('DECLINED', $response->getMessage());
    }

    public function test_send_unable_to_process(): void
    {
        $this->setMockHttpResponse('PurchaseUnableToProcess.txt');
        $response = $this->request->send();

        self::assertFalse($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertNull($response->getTransactionReference());
        self::assertSame('Invalid Total Amount. Error (007)', $response->getMessage());
    }
}
