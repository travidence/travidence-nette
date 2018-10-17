<?php

namespace Travidence\Entity;


class Trip
{
    /** @var Person */
    protected $traveller;

    /** @var TripSegment[] */
    protected $segments;
}