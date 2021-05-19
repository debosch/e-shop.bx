<?php

namespace Team\Models\Blogic;

use Team\Core\Model;

class Auth extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function action($user_login = '', $user_password = '')
	{
		//session_start();

		$user_login = htmlspecialchars(filter_var(trim($user_login), FILTER_SANITIZE_STRING));
		$user_password = htmlspecialchars(filter_var(trim($user_password), FILTER_SANITIZE_STRING));

		$password = $this->verifyLogin($user_login);
		if ($this->verifyPass($user_password, $password))
		{
			$this->setActivity($user_login);
			$_SESSION['admin'] = true;
			header('Location: ../main/catalog');
			exit();
		}
		else
		{
			$_SESSION['error'] = 'Введены неверные данные';
			header('Location: ../main/login');
			exit();
		}
	}

	private function verifyLogin($user_login)
	{
		$stm = $this->db->prepare(
			"SELECT PASSWORD FROM admin
		WHERE LOGIN = :login"
		);
		$stm->bindParam(':login', $user_login);
		$stm->execute();
		$password = $stm->fetch();
		$password = $password[0];

		return $password;
	}

	private function verifyPass($user_password, $password)
	{
		$user_password = hash('sha256', $user_password);
		$password = substr($password, 0, -15);
		if ($user_password === $password)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	private function setActivity($user_login)
	{
		$current_timestamp = date('Y-m-d H:i:s');
		$stm = $this->db->prepare("UPDATE admin SET LAST_ACTIVITY = :la WHERE LOGIN = :login");
		$stm->bindParam(':login', $user_login);
		$stm->bindParam(':la', $current_timestamp);
		$stm->execute();
	}

	public static function isAuth()
	{
		session_start();
		if (empty($_SESSION['admin']))
		{
			header('Location: http://team-a-2020/admin/main/login');
			exit();
		}
	}
}


