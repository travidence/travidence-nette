<?php

namespace Travidence\Components;

use Nette\Application\UI\Control;
use Nette\Application\UI\Multiplier;
use Travidence\Forms\FormFactory;


class TripFormControl extends Control
{
    public function render()
    {
        // vložíme do šablony nějaké parametry
        //$this->template->param = $value;
        // a vykreslíme ji
        $this->template->render(__DIR__ . '/tripForm.latte');
    }

    public function createComponentForm()
    {
        $form = (new FormFactory())->create();

        $traveller = $form->addContainer('traveller');
        $traveller->addText("name", "Jméno");
        $traveller->addText("surname", "Přijmení");
        $traveller->addText("workStation", "Místo výkonu práce");
        $traveller->addText("department", "Oddělení");

        $form['segments'] = $this->segmentsMultiplier();

        $form->addSubmit("submit", "K Tisku");
        return $form;
    }

    public function segmentsMultiplier()
    {
        return new Multiplier(function () {
            return new TripSegmentContainer();
        });
    }

}