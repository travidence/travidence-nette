<?php

namespace Travidence\Rest\Controllers;


use Travidence\Model\Entity\Person;
use Travidence\Model\Entity\Trip;
use Travidence\Model\Entity\TripSegment;
use Travidence\Model\TripDao;
use Travidence\Model\Validator\ValidationException;

class TripController extends ARestController
{
    /** @var TripDao @inject */
    public $tripDao;

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
            $trip = $this->tripDao->parse($data->trip);
            $key = $this->tripDao->store($trip);
            return ['result' => $key];
        } catch (ValidationException $ex) {
            dump($ex->getErrors());
            exit;
        }


    }
}