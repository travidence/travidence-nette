<?php

namespace Travidence\Presenters;


final class HomepagePresenter extends BasePresenter
{
    public function renderDefault()
    {
        $this->template->anyVariable = 'any value';
    }
}
