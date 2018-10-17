<?php

namespace Travidence\Model;


use Travidence\Entity\Trip;
use Travidence\Entity\TripSegment;

class TripService
{
    public function __construct()
    {
        
    }

    public function getTrip($id)
    {
        $trip =  new Trip();
        $segment = new TripSegment();
        $segment->setStartPlace("something");
        $trip->setSegments([segment]);

    }
}