<?php

namespace Travidence\Rest\Controllers;


use Travidence\Entity\Person;
use Travidence\Entity\Trip;
use Travidence\Entity\TripSegment;

class TripController extends ARestController
{
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
        $data = $this->request->getJsonBody();
        dump($data);
        exit;
    }
}