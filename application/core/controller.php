<?php

namespace Team\Core;


class Controller
{

	public $model;
	public $view;

	function __construct()
	{
		$this->view = new \Team\Core\View();
	}
}

