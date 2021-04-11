<?php

namespace Omnipay\eProcessingNetwork\Request;

use Omnipay\Common\Message\AbstractRequest as OmnipayAbstractRequest;

abstract class AbstractRequest extends OmnipayAbstractRequest
{
    protected string $url;

    public function getData()
    {
        if ($this->getTestMode()) {

        }
    }

    public function sendData($data) {
        $response = $this->sendRequest($data);
        $body = (string)($response->getBody());
        $body = $this->removeBOM($body);
        $data = json_decode($body, true);
        return new Response($this, $data);
    }
}
