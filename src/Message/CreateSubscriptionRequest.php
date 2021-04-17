<?php

namespace Omnipay\eProcessingNetwork\Message;

use Omnipay\Common\Message\RequestInterface;
use Omnipay\eProcessingNetwork\Helpers\Schedule;
use Omnipay\eProcessingNetwork\Message\Concerns\HasAddressData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasCreditCardData;
use Omnipay\eProcessingNetwork\Message\Concerns\HasSubscriptionData;

class CreateSubscriptionRequest extends AbstractRequest
{
    use HasAddressData;
    use HasCreditCardData;
    use HasSubscriptionData;

    protected string $url = 'https://www.eprocessingnetwork.com/cgi-bin/epn/secure/tdbe/transact.pl';
    protected string $requestType = 'transaction';
    protected string $tranType = 'Sale';

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function getData(): array
    {
        $this->validate('amount', 'card', 'subscriptionName', 'schedule');

        return array_merge(
            [
                'RequestType' => $this->requestType,
                'TranType' => $this->tranType,
                'Total' => $this->getAmount(),
            ],
            $this->getAddressData(),
            $this->getCreditCardData(),
            [
                'RecurMethodID' => '0',
                // Submit the value "0" to indicate you are creating a recurring transaction on the fly
                'Identifier' => $this->getName(),
                'RCRRecurAmount' => $this->getRecurringAmount() ?? $this->getAmount(),
                'RCRRecurs' => $this->getSchedule()->getOccurrences(),
                'RCRChargeWhen' => 'OnDayOfCycle',
                'RCRPeriod' => $this->getSchedule()->getInterval(),
                'RCRStartOnDay' => $this->getSchedule()->getStartDate()->format('m~d~Y'),
            ]
        );
    }
}
