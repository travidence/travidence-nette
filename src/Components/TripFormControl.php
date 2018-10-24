<?php

namespace Travidence\Components;
use Nette\Application\UI\Control;
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
        $traveller->addText("work_place", "Místo výkonu práce");
        $traveller->addText("department", "Oddělení");

        $segment = $form->addContainer('segment');
        $segment->addDate("date", "Datum");
        $segment->addText("purpose", "Cíl cesty");
        $segment->addText("startPlace", "Místo");
        $segment->addText("endPlace", "Místo");
        $segment->addTime("startTime", "Čas");
        $segment->addTime("endTime", "Čas");

        $segment->addText("meanOfTransport", "Použitý dopravní prostředek");

        $segment->addNumber("distance", "Vzdálenost");
        $segment->addTime("driveTime", "Doba řízení");
        $segment->addNumber("usedFuel", "Spotřeba", 0)
            ->setAttribute('step', 0.1);
        $segment->addText("licensePlate", "Registrační značka");

        $expenses = $segment->addContainer('expenses');
        $expenses->addNumber("otherExpenses", "Vedlejší výdaje", 0);
        $expenses->addNumber("beddingExpenses", "Nocležné", 0);
        $expenses->addNumber("foodServings", "Počet poskytovaných služeb", 0);
        $expenses->addNumber("foodExpenses", "Stravné", 0);

        $form->addSubmit("submit", "K Tisku");
        return $form;
    }

}