<?php

namespace Travidence\Model;


use Travidence\Entity\Trip;
use Travidence\Entity\TripSegment;
use Travidence\Model\Validator\AnnotatedPropertyValidator;
use Travidence\Model\Validator\ValidationException;

class TripService
{
    /** @var \JsonMapper */
    private $mapper;
    /** @var AnnotatedPropertyValidator */
    private $validator;

    public function __construct(\JsonMapper $mapper, AnnotatedPropertyValidator $validator)
    {
        $this->mapper = $mapper;
        $this->validator = $validator;
    }

    /**
     * @param \stdClass $data
     * @return Trip
     *
     * @throws ValidationException
     */
    public function parse($data): Trip
    {
        try {
            /** @var Trip $object */
            $object = $this->mapper->map($data, new Trip());
            $errors = $this->validator->validate($object);
            if (!empty($errors)) {
                throw new ValidationException($errors);
            }

            return $object;
        } catch (\JsonMapper_Exception $ex) {
            throw new ValidationException([
                "Validation failed due to: " . $ex->getMessage(),
            ]);
        }
    }

    public function getTrip($id)
    {
        $trip =  new Trip();
        $segment = new TripSegment();
        $segment->setStartPlace("something");
        $trip->setSegments([segment]);

    }
}