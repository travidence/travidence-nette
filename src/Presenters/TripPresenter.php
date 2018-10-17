<?php

namespace Travidence\Presenters;


use Travidence\Components\TripFormControl;
use Travidence\Model\TripService;

class TripPresenter extends BasePresenter
{
    /** @var TripService */
    private $tripService;

    public function renderCreateNew()
    {
        // todo: use DI
        $this->tripService = new TripService();
    }

    public function createComponentTripForm()
    {
        return new TripFormControl();
    }

    public function renderSummary($id)
    {
        $trip = $this->tripService->getTrip($id);

    }
}