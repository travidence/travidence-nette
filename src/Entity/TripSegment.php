<?php

namespace Travidence\Entity;


class TripSegment extends BaseEntity
{
    /** @var \DateTime */
    protected $startDate;
    /** @var \DateTime */
    protected $endDate;

    /** @var string */
    protected $startPlace;
    /** @var string */
    protected $endPlace;

    /** @var string */
    protected $meanOfTransport;

    /** @var TripSegmentExtraCar */
    protected $extra;
    /** @var TripSegmentExpenses */
    protected $expenses;

    /**
     * @return \DateTime
     */
    public function getStartDate(): \DateTime
    {
        return $this->startDate;
    }

    /**
     * @param \DateTime $startDate
     */
    public function setStartDate(\DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return \DateTime
     */
    public function getEndDate(): \DateTime
    {
        return $this->endDate;
    }

    /**
     * @param \DateTime $endDate
     */
    public function setEndDate(\DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return string
     */
    public function getStartPlace(): string
    {
        return $this->startPlace;
    }

    /**
     * @param string $startPlace
     */
    public function setStartPlace(string $startPlace): void
    {
        $this->startPlace = $startPlace;
    }

    /**
     * @return string
     */
    public function getEndPlace(): string
    {
        return $this->endPlace;
    }

    /**
     * @param string $endPlace
     */
    public function setEndPlace(string $endPlace): void
    {
        $this->endPlace = $endPlace;
    }

    /**
     * @return string
     */
    public function getMeanOfTransport(): string
    {
        return $this->meanOfTransport;
    }

    /**
     * @param string $meanOfTransport
     */
    public function setMeanOfTransport(string $meanOfTransport): void
    {
        $this->meanOfTransport = $meanOfTransport;
    }

    /**
     * @return TripSegmentExtraCar
     */
    public function getExtra(): TripSegmentExtraCar
    {
        return $this->extra;
    }

    /**
     * @param TripSegmentExtraCar $extra
     */
    public function setExtra(TripSegmentExtraCar $extra): void
    {
        $this->extra = $extra;
    }

    /**
     * @return TripSegmentExpenses
     */
    public function getExpenses(): TripSegmentExpenses
    {
        return $this->expenses;
    }

    /**
     * @param TripSegmentExpenses $expenses
     */
    public function setExpenses(TripSegmentExpenses $expenses): void
    {
        $this->expenses = $expenses;
    }
}