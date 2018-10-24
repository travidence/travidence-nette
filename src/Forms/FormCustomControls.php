<?php

namespace Travidence\Forms;


use Nette\Forms\Controls\TextInput;

trait FormCustomControls
{
    public function addContainer($name)
    {
        $control = new Container();
        $control->currentGroup = $this->currentGroup;
        if ($this->currentGroup !== null) {
            $this->currentGroup->add($control);
        }

        return $this[$name] = $control;
    }

    public function addNumber(string $name, string $label = null, float $min = null, float $max = null)
    {
        /** @var TextInput $control */
        $control = $this->addText($name, $label);
        $control->setAttribute('type', 'number');
        if(is_numeric($min)) {
            $control->setAttribute('min', $min);
        }
        if(is_numeric($max)) {
            $control->setAttribute('max', $max);
        }

        return $control;
    }

    public function addDate(string $name, string $label = null)
    {
        /** @var TextInput $control */
        $control = $this->addText($name, $label);
        $control->setAttribute('type', 'date');

        return $control;
    }

    public function addTime(string $name, string $label = null)
    {
        /** @var TextInput $control */
        $control = $this->addText($name, $label);
        $control->setAttribute('type', 'time');

        return $control;
    }
}