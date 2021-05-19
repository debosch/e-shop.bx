<?php

namespace Team\Core;
class Errors
{
	private static $controller;
	public static $error;
	public static function e404()
	{
		self::$controller=new \Team\Core\Controller();
		self::$controller->view->generate('e404.php','template_empty.php');
	}
}