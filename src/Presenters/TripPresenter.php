<?php

namespace Travidence\Presenters;


use Travidence\Components\TripFormControl;
use Travidence\Model\TripDao;

class TripPresenter extends BasePresenter
{
    /** @var TripDao @inject */
    public $tripDao;

    public function createComponentTripForm()
    {
        return new TripFormControl();
    }

    public function renderSummary($id)
    {
        $trip = $this->tripDao->getTrip($id);

        $this->template->trip = $trip;
    }
}