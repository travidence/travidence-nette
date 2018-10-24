<?php

namespace Travidence\Forms;

use Nette;


final class FormFactory
{
	use Nette\SmartObject;

	/**
	 * @return Form
	 */
	public function create()
	{
		$form = new Form();
		return $form;
	}
}
