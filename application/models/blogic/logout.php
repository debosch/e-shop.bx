<?php
namespace Team\Models\Blogic;

use Team\Core\Model;

class Logout extends Model
{
	public function __construct()
	{
		parent::__construct();
	}
	public function action()
	{
		session_start();
		session_destroy();
		header('Location: ../main/login');
		exit();
	}
}

