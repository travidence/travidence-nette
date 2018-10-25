<?php

namespace Travidence\Model\Entity;


/**
 * Class Trip
 * @package Travidence\Model\Entity
 *
 * @property Person        $traveller @required
 * @property TripSegment[] $segments
 * @property string[]      $note
 */
class Trip extends BaseEntity
{
    /** @var Person */
    protected $traveller;
    /** @var TripSegment[] */
    protected $segments = [];
    /** @var string */
    protected $note = "";

    public function getTraveller(): ?Person
    {
        return $this->traveller;
    }

    public function setTraveller(Person $traveller = null): Trip
    {
        $this->traveller = $traveller;
        return $this;
    }

    /** @return TripSegment[] */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * @param TripSegment[] $segments
     *
     * @return Trip
     */
    public function setSegments(array $segments = []): Trip
    {
        $this->segments = $segments;
        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): Trip
    {
        $this->note = $note;
        return $this;
    }

    public function sumExpenses($property): float
    {
        return array_reduce($this->segments, function ($sum, TripSegment $segment) use ($property) {
            return $sum + $segment->expenses->$property;
        }, 0);
    }

    public function getTotalExpenses()
    {
        return array_reduce($this->segments, function ($sum, TripSegment $segment) {
            return $sum + $segment->getTotalExpenses();
        }, 0);
    }
}