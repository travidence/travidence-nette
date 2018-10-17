<?php

namespace Travidence\Presenters;


use Travidence\Components\TripFormControl;

class TripPresenter extends BasePresenter
{
    public function renderCreateNew() {

    }

    public function createComponentTripForm()
    {
        return new TripFormControl();
    }
}