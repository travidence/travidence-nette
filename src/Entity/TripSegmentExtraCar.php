<?php

namespace Travidence\Entity;


class TripSegmentExtraCar extends BaseEntity
{
    /**
     * [Km]
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
    public function getDistance(): float
    {
        return $this->distance;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return int
     */
    public function getDriveTime(): int
    {
        return $this->driveTime;
    }

    /**
     * @param int $driveTime
     */
    public function setDriveTime(int $driveTime): void
    {
        $this->driveTime = $driveTime;
    }

    /**
     * @return float
     */
    public function getConsumption(): float
    {
        return $this->consumption;
    }

    /**
     * @param float $consumption
     */
    public function setConsumption(float $consumption): void
    {
        $this->consumption = $consumption;
    }

    /**
     * @return string
     */
    public function getLicensePlate(): string
    {
        return $this->licensePlate;
    }

    /**
     * @param string $licensePlate
     */
    public function setLicensePlate(string $licensePlate): void
    {
        $this->licensePlate = $licensePlate;
    }
}