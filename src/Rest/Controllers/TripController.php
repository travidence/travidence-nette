<?php

namespace Travidence\Rest\Controllers;


use Travidence\Model\Entity\Person;
use Travidence\Model\Entity\Trip;
use Travidence\Model\Entity\TripSegment;
use Travidence\Model\TripService;
use Travidence\Model\Validator\ValidationException;

class TripController extends ARestController
{
    /** @var TripService @inject */
    public $tripService;

    public function actionGet()
    {
        $trip = new Trip();

        $person = new Person();
        $person->setName("Bořek");
        $person->setSurname("Stavitel");
        $person->setDepartment("Whoop whoop");
        $person->setWorkStation("Stattiooon");

        $trip->setTraveller($person);


        $trip->setSegments([
            new TripSegment()
        ]);

        $trip->setNote("Yalalala");

        return $trip->asArray();
    }

    public function actionPost()
    {
        $data = $this->request->getJsonBody(false);
        try {
            $trip = $this->tripService->parse($data->trip);
            return $trip->asArray();
        } catch (ValidationException $ex) {
            dump($ex->getErrors());
            exit;
        }



    }
}