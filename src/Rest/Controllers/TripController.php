<?php

namespace Travidence\Rest\Controllers;


class TripController extends ARestController
{
    public function actionGet() {
        dump($this->request);
        $data = $this->request->getJsonBody();
        dump($data); exit;
    }
}