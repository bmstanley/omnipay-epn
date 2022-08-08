<?php

namespace Omnipay\eProcessingNetwork\Helpers;

use DateTime;
use Omnipay\Common\Exception\InvalidRequestException;

class Schedule
{
    public const INTERVAL_WEEKLY = 'Weekly';
    public const INTERVAL_BIWEEKLY = 'BiWeekly';
    public const INTERVAL_MONTHLY = 'Monthly';
    public const INTERVAL_BIMONTHLY = '2Months';
    public const INTERVAL_QUARTERLY = '3Months';
    public const INTERVAL_BIANNUALLY = '6Months';
    public const INTERVAL_ANNUALLY = '12Months';

    /**
     * @var string
     */
    protected $interval;
    /**
     * @var \DateTime
     */
    protected $startDate;
    /**
     * @var int
     */
    protected $occurrences = 0; // Process the recur until it is explicitly canceled

    /**
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function __construct(string $interval, $startDate, int $occurrences = 0)
    {
        $this->setInterval($interval);
        $this->setStartDate($startDate);
        $this->setOccurrences($occurrences);
    }

    /**
     * @param string $value
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function setInterval(string $value): void
    {
        if (!in_array($value, (new \ReflectionClass($this))->getConstants(), true)) {
            throw new InvalidRequestException('Invalid interval given');
        }

        $this->interval = $value;
    }

    /**
     * @return string
     */
    public function getInterval(): string
    {
        return $this->interval;
    }

    /**
     * @param \DateTime|string $value
     * @throws \Omnipay\Common\Exception\InvalidRequestException
     */
    public function setStartDate($value): void
    {
        if (! $value instanceof DateTime) {
            $value = DateTime::createFromFormat('Y-m-d', $value);
            if ($value === false) {
                throw new InvalidRequestException('Start date must be either a DateTime instance or Y-m-d formatted string');
            }
        }

        $this->startDate = $value;
    }

    /**
     * @return \DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    public function setOccurrences(int $value): void
    {
        if ($value < 0) {
            throw new InvalidRequestException('Number of occurrences must be greater than 0');
        }

        $this->occurrences = $value;
    }

    /**
     * @return int
     */
    public function getOccurrences(): int
    {
        return $this->occurrences;
    }
}
