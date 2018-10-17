<?php
/**
 * Created by PhpStorm.
 * User: Kanto
 * Date: 17.10.2018
 * Time: 12:11
 */

namespace Travidence\Components;


use Nette\Application\UI\Control;
use Nette\Application\UI\Form;

class TripSegmentControl extends Control
{
    public function render()
    {
        // vložíme do šablony nějaké parametry
        //$this->template->param = $value;
        // a vykreslíme ji

        $this->template->render(__DIR__ . '/tripForm.latte');
    }

    public function createComponentTripRow() {

        return new TripFormControl();
    }



}