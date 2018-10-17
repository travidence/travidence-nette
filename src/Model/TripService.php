<?php

namespace Travidence\Model;


use Travidence\Entity\Trip;

class TripService
{
    public function __construct()
    {
        
    }

    public function getTrip($id)
    {
        return new Trip();
    }
}