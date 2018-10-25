<?php

namespace Travidence\Model\Entity;

/**
 * Class TripSegmentExtraCar
 * @package Travidence\Model\Entity
 *
 * @property float  $distance     @required
 * @property int    $driveTime    @required
 * @property float  $consumption  @required
 * @property string $licensePlate @required
 * @property float  $gasPrice
 *
 * @property-read float $expense
 */
class TripSegmentExtraCar extends BaseEntity
{
    /**
     * @var float
     */
    protected $distance;

    /**
     * [minutes]
     * @var int
     */
    protected $driveTime;

    /**
     * [l/100km]
     * @var float
     */
    protected $consumption;
    /** @var string */
    protected $licensePlate;
    /** @var float */
    protected $gasPrice = 0;

    /**
     * @return float
     */
    public function getDistance(): ?float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     *
     * @return TripSegmentExtraCar
     */
    public function setDistance(float $distance): TripSegmentExtraCar
    {
        $this->distance = $distance;
        return $this;
    }

    /**
     * @return int
     */
    public function getDriveTime(): ?int
    {
        return $this->driveTime;
    }

    /**
     * @param int $driveTime
     *
     * @return TripSegmentExtraCar
     */
    public function setDriveTime(int $driveTime): TripSegmentExtraCar
    {
        $this->driveTime = $driveTime;
        return $this;
    }

    /**
     * @return float
     */
    public function getConsumption(): ?float
    {
        return $this->consumption;
    }

    /**
     * @param float $consumption
     *
     * @return TripSegmentExtraCar
     */
    public function setConsumption(?float $consumption): TripSegmentExtraCar
    {
        $this->consumption = $consumption;
        return $this;
    }

    /**
     * @return string
     */
    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    /**
     * @param string $licensePlate
     *
     * @return TripSegmentExtraCar
     */
    public function setLicensePlate(string $licensePlate): TripSegmentExtraCar
    {
        $this->licensePlate = $licensePlate;
        return $this;
    }

    /**
     * @return float
     */
    public function getGasPrice(): float
    {
        return $this->gasPrice;
    }

    /**
     * @param float $gasPrice
     */
    public function setGasPrice(float $gasPrice): void
    {
        $this->gasPrice = $gasPrice;
    }

    /** @return float */
    public function getExpense() {
        return $this->distance / $this->consumption * $this->gasPrice;
    }


}