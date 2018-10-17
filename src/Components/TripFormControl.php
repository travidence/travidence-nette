<?php
/**
 * Created by PhpStorm.
 * User: Kanto
 * Date: 17.10.2018
 * Time: 11:51
 */

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
        $form->addText("date", "Datum");
        $form->addText("purpose", "Cíl cesty");
        $form->addText("place1", "Místo");
        $form->addText("place2", "Místo");
        $form->addText("time1", "Čas");
        $form->addText("time2", "Čas");

        $form->addText("vehicle", "Použitý dopravní prostředek");
        $form->addText("distance", "Vzdálenost");
        $form->addText("driveTime", "Doba řízení");
        $form->addText("usedFuel", "Spotřeba");
        $form->addText("sign", "Registrační značka");


        $form->addText("extends", "Vedlejší výdaje");
        $form->addText("overNight", "Nocležné");
        $form->addText("numService", "Počet poskytovaných služeb");
        $form->addText("food", "Stravné");



        $form->addSubmit("submit", "K Tisku");
        return $form;
    }

}