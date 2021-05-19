<?php

namespace Team\Models\Blogic;

class Orders
{

	public function getOrders($args)
	{
		$orderDB = new \Team\Models\DB\OrderDB();
		$orders = $orderDB->getOrdersTable($args['status']);
		//var_dump($orderDB->getOrdersTable($args['status']));
		for ($i = 0, $iMax = count($orders); $i < $iMax; $i++)
		{
			$orders[$i]['ITEMS'] = $orderDB->getItemsByOrder($orders[$i]['ID']);
		}
		return json_encode($orders);
	}

	public function setOrder()
	{
		if(!$this->validateSetOrders($_POST))
		{
			echo 'Ошибка';
			exit();
		}
		$orderDB = new \Team\Models\DB\OrderDB();
		$orderDB->changeOrderStatus($_POST['id'], $_POST['status']);
		if ($_POST['status'] == 'processed')
		{
			$userData = $orderDB->getUserData($_POST['id']);
			$message = new \Team\Models\Blogic\Sendmessage();
			$message->sendMail($userData["NAME"], $userData["EMAIL"]);
		}
		echo 'success';
	}

	private function validateSetOrders($args): bool
	{
		if((!array_key_exists('status',$args)) || (!array_key_exists('id',$args)))
		{
			return false;
		}
		if ($args['status'] != 'processed' && $args['status'] != 'completed')
		{
			return false;
		}
		$orderDB = new \Team\Models\DB\OrderDB();
		if(empty($orderDB->checkOrderId($args['id'])))
		{
			return false;
		}
		return true;
	}
}