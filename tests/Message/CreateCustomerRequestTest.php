<?php

namespace Omnipay\eProcessingNetwork\Tests\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\eProcessingNetwork\Message\CreateCustomerRequest;
use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
    /**
     * @var \Omnipay\eProcessingNetwork\Message\CreateCustomerRequest
     */
    private $request;

    public function setUp(): void
    {
        parent::setUp();

        $this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest());
        $this->request->initialize(
            [
                'customerName' => 'Tester McTest',
                'customerEmail' => 'test.mctester@email.com',
                'customerPhone' => '555-555-5555',
                'customerLocalIdentifier' => 'ABC-1234',
            ]
        );
    }

    public function test_create_customer_success(): void
    {
        $this->setMockHttpResponse('CreateCustomerSuccess.txt');
        $response = $this->request->send();

        self::assertTrue($response->isSuccessful());
        self::assertFalse($response->isRedirect());
        self::assertSame('8', $response->getCustomerReference());
    }
}
