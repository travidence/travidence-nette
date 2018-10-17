<?php

namespace Travidence\Model\Parser;


use Nette\InvalidArgumentException;
use Travidence\Entity\Person;
use Travidence\Entity\Trip;
use Travidence\Entity\TripSegment;
use Travidence\Entity\TripSegmentExpenses;
use Travidence\Entity\TripSegmentExtraCar;

class TripParser
{
    private $parsers;

    public function __construct()
    {
        $this->parsers = [
            Person::class => [$this, 'parsePerson'],
            Trip::class => [$this, 'parseTrip'],
            TripSegment::class => [$this, 'parseTripSegment'],
            TripSegmentExpenses::class => [$this, 'parseTripSegmentExpenses'],
        ];
    }

    public function parsePerson(array $data): Person
    {
        return $this->parseGeneric(Person::class, $data, [
            'name' => 'string',
            'surname' => 'string',
            'department' => 'string',
            'workStation' => 'string',
        ]);
    }

    public function parseTrip(array $data): Trip
    {


        return $this->parseGeneric(Trip::class, $data, [
            'traveller' => $this->parsers[Person::class],
            'segments' => function ($d) {
                return $this->mapArray($d, TripSegment::class);
            }
        ]);
    }

    public function parseTripSegment(array $data): TripSegment
    {
        /** @var TripSegment $tripSegment */
        $tripSegment = $this->parseGeneric(TripSegment::class, $data, [
            'startDate' => \DateTime::class,
            'endDate' => \DateTime::class,
            'startPlace' => 'string',
            'endPlace' => 'string',
            'meanOfTransport' => 'string'
        ]);

        if ($tripSegment->getMeanOfTransport() == 'car') {
            $tripSegment->setExtra($this->parseTripSegmentExtraCar($data['extra']));
        }

        return $tripSegment;
    }

    public function parseTripSegmentExpenses(array $data): TripSegmentExpenses
    {
        return $this->parseGeneric(TripSegmentExpenses::class, $data, [
            'beddingExpenses' => 'float',
            'foodExpenses' => 'float',
            'foodServings' => 'int',
            'otherExpenses' => 'float'
        ]);
    }

    public function parseTripSegmentExtraCar(array $data): TripSegmentExtraCar
    {
        return $this->parseGeneric(TripSegmentExtraCar::class, $data, [
            'distance' => 'float',
            'driveTime' => 'float',
            'consumption' => 'float',
            'licensePlate' => 'string',
        ]);
    }

    protected function parseGeneric($class, array $data, array $types)
    {
        $instance = new $class();
        foreach ($types as $key => $type) {
            if (!isset($data[$key])) {
                throw new InvalidArgumentException("Failed to parse '$class', \$data is missing $key");
            }
            $value = $data[$key];

            if (is_callable($type)) {
                $value = call_user_func($type, $value);
            } else if (gettype($data[$key]) != $type) {
                throw new InvalidArgumentException("Failed to parse '$class', \$data['$key'] must be of type '$type'");
            }

            $instance->$key = $value;
        }

        return $instance;
    }

    protected function mapArray(array $arrayData, string $class): array
    {
        return array_map(function ($individualData) use ($class) {
            return $this->parsers[$class]($individualData);
        }, $arrayData);
    }

}