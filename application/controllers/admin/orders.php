<?php

namespace Team\controllers\admin;

use Team\Core\Controller;

class Orders extends Controller
{
	public function getOrders($args)
	{
		\Team\Models\Blogic\Auth::isAuth();
		if (!array_key_exists('status', $args) ||
			($args['status'] != 'new' && $args['status'] != 'processed' && $args['status'] != 'completed'))
		{
			echo 'Невалидный запрос';
			exit();
		}
		$orders = new \Team\Models\Blogic\Orders();
		echo $orders->getOrders($args);
	}

	public function setOrder()
	{
		\Team\Models\Blogic\Auth::isAuth();
		$order = new \Team\Models\Blogic\Orders();
		$order->setOrder();
	}



}