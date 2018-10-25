<?php

namespace Travidence\Components;


use Nette;
use Travidence\Forms\Container;

class TripSegmentContainer extends Container
{
    public function __construct(Nette\ComponentModel\IContainer $parent = null, $name = null)
    {
        parent::__construct($parent, $name);

        $this->addControls();
    }

    private function addControls() {
        $this->addDate("date", "Datum");
        $this->addText("purpose", "Cíl cesty");
        $this->addText("startPlace", "Místo");
        $this->addText("endPlace", "Místo");
        $this->addTime("startTime", "Čas");
        $this->addTime("endTime", "Čas");

        $this->addText("meanOfTransport", "Použitý dopravní prostředek");

        $this->addNumber("distance", "Vzdálenost");
        $this->addTime("driveTime", "Doba řízení");
        $this->addNumber("usedFuel", "Spotřeba", 0)
            ->setAttribute('step', 0.1);
        $this->addText("licensePlate", "Registrační značka");

        $expenses = $this->addContainer('expenses');
        $expenses->addNumber("otherExpenses", "Vedlejší výdaje", 0);
        $expenses->addNumber("beddingExpenses", "Nocležné", 0);
        $expenses->addNumber("foodServings", "Počet poskytovaných služeb", 0);
        $expenses->addNumber("foodExpenses", "Stravné", 0);
    }


    public function renderCard($renderFormTag = true)
    {
        $this->template->renderFormTag = $renderFormTag;
        $this->template->render(__DIR__ . '/tripSegmentFormCard.latte');
    }
}