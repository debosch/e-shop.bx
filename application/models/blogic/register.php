<?php

namespace Team\Models\Blogic;

use Team\Core\Model;

class Register extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function action($user_login = '', $user_password = '', $user_second = '')
	{
		//session_start();
		$user_login = htmlspecialchars(filter_var(trim($user_login), FILTER_SANITIZE_STRING));
		$user_password = htmlspecialchars(filter_var(trim($user_password), FILTER_SANITIZE_STRING));
		$user_second = htmlspecialchars(filter_var(trim($user_second), FILTER_SANITIZE_STRING));
		if (mb_strlen($user_login) < 3 || mb_strlen($user_login) > 20)
		{
			$_SESSION['error'] = 'Недопустимая длина логина';
			header('Location: ../main/register');
			exit();
		}
		elseif (mb_strlen($user_password) < 7 || mb_strlen($user_password) > 50)
		{
			$_SESSION['error'] = 'Недопустимая длина пароля';
			header('Location: ../main/register');
			exit();
		}
		elseif ($user_password !== $user_second)
		{
			$_SESSION['error'] = 'Пароли несовпадают';
			header('Location: ../main/register');
			exit();
		}
		if ($this->checkLogin($user_login))
		{
			$_SESSION['error'] = 'Пользователь уже существует';
			header('Location: ../main/register');
			exit();
		}
		else
		{
			$this->addAdmin($user_login, $user_password);
			header('Location: ../main/success');
			exit();
		}
	}

	private function checkLogin($login): bool
	{
		$stm = $this->db->prepare(
			"SELECT LOGIN FROM admin where LOGIN = :login"
		);
		$stm->bindParam(':login', $login);
		$stm->execute();
		if ($stm->fetch() > 0)
		{
			return true;
		}
		return false;
	}

	private function addAdmin($login, $password)
	{
		$password = hash('sha256', $password).$this->salt();
		$stm = $this->db->prepare(
			"INSERT INTO admin (LOGIN, PASSWORD) 
			VALUE (:login, :password)"
		);
		$stm->bindParam(':login', $login);
		$stm->bindParam(':password', $password);
		$stm->execute();
	}

	private function salt()
	{
		$chars = "abcdefghijklmnopqrstuvwxyz1234567890";
		$code = "";
		while(strlen($code) < 15)
		{
			$code.= $chars[mt_rand(0, strlen($chars) - 1)];
		}
		return $code;
	}
}