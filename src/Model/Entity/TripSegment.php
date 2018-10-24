<?php

namespace Travidence\Model\Entity;

use DateTime;

/**
 * Class TripSegment
 * @package  Travidence\Model\Entity
 *
 * @property DateTime            $startDate       @required
 * @property DateTime            $endDate         @required
 * @property string              $startPlace      @required
 * @property string              $endPlace        @required
 * @property string              $meanOfTransport @required
 * @property string              $purpose         @required
 * @property TripSegmentExtraCar $extra
 * @property TripSegmentExpenses $expenses        @required
 */
class TripSegment extends BaseEntity
{
    /** @var DateTime */
    protected $startDate;
    /** @var DateTime */
    protected $endDate;

    /** @var string */
    protected $startPlace;
    /** @var string */
    protected $endPlace;

    /** @var string */
    protected $purpose;

    /** @var string */
    protected $meanOfTransport;

    /** @var TripSegmentExtraCar */
    protected $extra;
    /** @var TripSegmentExpenses */
    protected $expenses;

    /**
     * @return DateTime
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     *
     * @return TripSegment
     */
    public function setStartDate(?DateTime $startDate): TripSegment
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime $endDate
     *
     * @return TripSegment
     */
    public function setEndDate(?DateTime $endDate): TripSegment
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getStartPlace(): ?string
    {
        return $this->startPlace;
    }

    /**
     * @param string $startPlace
     *
     * @return TripSegment
     */
    public function setStartPlace(?string $startPlace): TripSegment
    {
        $this->startPlace = $startPlace;
        return $this;
    }

    /**
     * @return string
     */
    public function getEndPlace(): ?string
    {
        return $this->endPlace;
    }

    /**
     * @param string $endPlace
     *
     * @return TripSegment
     */
    public function setEndPlace(?string $endPlace): TripSegment
    {
        $this->endPlace = $endPlace;
        return $this;
    }

    /**
     * @return string
     */
    public function getMeanOfTransport(): ?string
    {
        return $this->meanOfTransport;
    }

    /**
     * @param string $meanOfTransport
     *
     * @return TripSegment
     */
    public function setMeanOfTransport(?string $meanOfTransport): TripSegment
    {
        $this->meanOfTransport = $meanOfTransport;
        return $this;
    }

    /**
     * @return string
     */
    public function getPurpose(): ?string
    {
        return $this->purpose;
    }

    /**
     * @param string $purpose
     *
     * @return TripSegment
     */
    public function setPurpose(?string $purpose): TripSegment
    {
        $this->purpose = $purpose;
        return $this;
    }



    /**
     * @return TripSegmentExtraCar
     */
    public function getExtra(): ?TripSegmentExtraCar
    {
        return $this->extra;
    }

    /**
     * @param TripSegmentExtraCar $extra
     *
     * @return TripSegment
     */
    public function setExtra(?TripSegmentExtraCar $extra): TripSegment
    {
        $this->extra = $extra;
        return $this;
    }

    /**
     * @return TripSegmentExpenses
     */
    public function getExpenses(): ?TripSegmentExpenses
    {
        return $this->expenses;
    }

    /**
     * @param TripSegmentExpenses $expenses
     *
     * @return TripSegment
     */
    public function setExpenses(?TripSegmentExpenses $expenses): TripSegment
    {
        $this->expenses = $expenses;
        return $this;
    }

}