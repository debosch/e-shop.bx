<?php
namespace Team\Controllers\Admin;

use Team\Core\Controller;

class Register extends Controller
{
	public function action()
	{
		session_start();
		if(!empty($_POST['login']) and !empty($_POST['password']) and !empty($_POST['confirmPassword']))
		{
			$modelRegister = new \Team\Models\Blogic\Register();
			$modelRegister->action($_POST['login'], $_POST['password'], $_POST['confirmPassword']);
		}
		else
		{
			$_SESSION['error'] = 'Введены не все поля';
			header('Location: ../main/register');
			exit();
		}
	}
}
