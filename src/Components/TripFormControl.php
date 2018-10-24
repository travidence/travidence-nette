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
        $form->addText("name", "Jméno");
        $form->addText("lastname", "Přijmení");
        $form->addText("work_place", "Místo výkonu práce");
        $form->addText("department", "Oddělení");

        $segment = $form->addContainer('segment');
        $segment->addDate("date", "Datum");
        $segment->addText("purpose", "Cíl cesty");
        $segment->addText("startPlace", "Místo");
        $segment->addText("endPlace", "Místo");
        $segment->addTime("startTime", "Čas");
        $segment->addTime("endTime", "Čas");

        $segment->addText("meanOfTransport", "Použitý dopravní prostředek");

        $segment->addNumber("distance", "Vzdálenost");
        $segment->addText("driveTime", "Doba řízení");
        $segment->addText("usedFuel", "Spotřeba");
        $segment->addText("licensePlate", "Registrační značka");

        $expenses = $segment->addContainer('expenses');
        $expenses->addText("otherExpenses", "Vedlejší výdaje");
        $expenses->addText("beddingExpenses", "Nocležné");
        $expenses->addText("foodServings", "Počet poskytovaných služeb");
        $expenses->addText("foodExpenses", "Stravné");



        $form->addSubmit("submit", "K Tisku");
        return $form;
    }

}