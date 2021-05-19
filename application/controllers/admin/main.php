<?php

namespace Team\Controllers\Admin;

use Team\Core\Controller;

class Main extends Controller
{
	public function add()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$this->view->generate('admin_add.php', 'template_admin.php');
	}

	public function order()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$this->view->generate('admin_order.php', 'template_admin.php');
	}

	public function orders()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$order = new \Team\Models\DB\OrderDB();
		$orderStatus = json_decode(file_get_contents('php://input'), true)['status'];
		echo json_encode($order->getOrders($orderStatus));
	}

	public function ordersAmount()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$order = new \Team\Models\DB\OrderDB();
		echo $order->getOrdersAmount()[0];
	}

	public function catalog()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$this->view->generate('admin_catalog.php', 'template_admin.php');

	}

	public function login()
	{
		$this->loginRedirection();
		$this->view->generate('admin_login.php', 'template_login.php');
	}

	public function register()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$this->view->generate('admin_register.php', 'template_register.php');
	}

	public function success()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$this->view->generate('admin_success.php', 'template_login_admin.php');
	}

	public function red()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$this->view->generate('admin_red.php', 'template_admin.php');
	}



	public function getTags()
	{
		$tag = new \Team\Models\DB\TagDB();
		echo json_encode($tag->getAllTags());
	}

	private function loginRedirection()
	{
		session_start();
		if (isset($_SESSION['admin']))
		{
			header('Location: catalog');
			exit();
		}
	}

}

