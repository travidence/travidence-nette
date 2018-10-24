<?php

namespace Travidence\Model;


use Nette\Caching\Storages\FileStorage;
use Nette\Utils\Json;
use Tracy\Debugger;
use Travidence\Exceptions\NotFoundException;
use Travidence\Model\Entity\Trip;
use Travidence\Model\Validator\AnnotatedPropertyValidator;
use Travidence\Model\Validator\ValidationException;

class TripDao
{
    /** @var \JsonMapper */
    private $mapper;
    /** @var AnnotatedPropertyValidator */
    private $validator;
    /** @var FileStorage */
    private $storage;

    public function __construct(\JsonMapper $mapper, AnnotatedPropertyValidator $validator, FileStorage $storage)
    {
        $this->mapper = $mapper;
        $this->validator = $validator;
        $this->storage = $storage;
    }

    /**
     * @param \stdClass $data
     *
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
            ], 'Validation failed', $ex);
        }
    }

    public function store(Trip $trip): string
    {
        if (empty($trip->segments)) {
            throw new ValidationException(["error.empty segments"]);
        }

        $properties = [
            $trip->getTraveller(),
            $trip->segments[0]->getStartDate()
        ];

        $key = md5(serialize($properties));

        $this->storage->write($key, $trip->asArray(), []);

        return $key;
    }

    public function getTrip(string $id): Trip
    {
        $serialized = $this->storage->read($id);
        if(!$serialized) {
            throw new NotFoundException('Trip');
        }
        // fixme: yuck, stdClass conversion is used for JsonMapper
        $serObj = Json::decode(Json::encode($serialized));
        try {
            $trip = $this->parse($serObj);
        } catch (ValidationException $ex) {
            dump($ex->getErrors());
            Debugger::exceptionHandler($ex);
        }

        return $trip;
    }
}