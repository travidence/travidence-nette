<?php

namespace Travidence\Model\Entity;

/**
 * Class TripSegmentExtraCar
 * @package Travidence\Model\Entity
 *
 * @property float $distance @required
 * @property int $driveTime @required
 * @property float $consumption @required
 * @property string $licensePlate @required
 */
class TripSegmentExtraCar extends BaseEntity
{
    /**
     * @var float
     */
    private $distance;

    /**
     * [minutes]
     * @var int
     */
    private $driveTime;

    /**
     * [l/100km]
     * @var float
     */
    private $consumption;
    /** @var string */
    private $licensePlate;

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


}