<?php

namespace Travidence\Entity;


class Trip extends BaseEntity
{
    /** @var Person */
    protected $traveller;

    /** @var TripSegment[] */
    protected $segments;

    /** @var string */
    protected $note;

    /**
     * @return Person
     */
    public function getTraveller(): Person
    {
        return $this->traveller;
    }

    /**
     * @param Person $traveller
     */
    public function setTraveller(Person $traveller): void
    {
        $this->traveller = $traveller;
    }

    /**
     * @return TripSegment[]
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * @param TripSegment[] $segments
     */
    public function setSegments(array $segments): void
    {
        $this->segments = $segments;
    }

    /**
     * @return string
     */
    public function getNote(): string
    {
        return $this->note;
    }

    /**
     * @param string $note
     */
    public function setNote(string $note): void
    {
        $this->note = $note;
    }
}