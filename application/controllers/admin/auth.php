<?php
namespace Team\Controllers\Admin;

use Team\Core\Controller;

class Auth extends Controller
{
	public function action()
	{
		session_start();
		if(!empty($_POST['login']) and !empty($_POST['password']))
		{
			$modelAuth = new \Team\Models\Blogic\Auth();
			$modelAuth->action($_POST['login'], $_POST['password']);
		}
		else
		{
			$_SESSION['error'] = 'Введены не все данные';
			header('Location: ../main/login');
			exit();
		}
	}
}
