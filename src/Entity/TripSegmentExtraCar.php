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
}