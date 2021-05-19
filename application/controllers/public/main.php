<?php

namespace Team\Controllers\Pub;

use Team\Core\Controller;
use Team\lib\FPSS;

class Main extends Controller
{
	function __construct()
	{
		$this->model = new \Team\Models\DB\ItemDB();
		$this->view = new \Team\Core\View();
	}

	public function index($args)
	{
		$data = $this->model->getItems();
		$this->view->generate('public_main.php', 'template_public.php', $data);
	}

	public function basket()
	{
		$this->view->generate('public_basket.php', 'template_public_order.php');
	}

	public function sendOrderFromBasket()
	{
		$order = new \Team\Models\DB\OrderDB();
		$item = new \Team\Models\DB\ItemDB();
		$orderData = json_decode(file_get_contents('php://input'), true);
		$validator = new \Team\lib\Validator();
		if(!$validator->validateEmail($orderData['email']))
		{
			echo "E-mail адрес <span style=\"color: red; \"><b>".$orderData['email']."</b></span> указан неверно<br>\n";
			return;
		}
		if (!$validator->validatePhoneNumber($orderData['phone']))
		{
			echo "Номер телефона <span style=\"color: red; \"><b>".$orderData['phone']."</b></span> указан неверно<br>\n";
			return;
		}
		$order->sendOrder($orderData['items'], $orderData['username'], $orderData['email'], $orderData['phone']);
		$item->decreaseItemAmount($orderData['items']);
	}

	public function getTotalAmountOfItems($args)
	{
		$item = new \Team\Models\DB\ItemDB();
		echo $item->getTotalAmount($args['id'])['AMOUNT'];
	}

	public function getProduct($args)
	{
		$getProduct = new \Team\Controllers\Shared\GetItem();
		echo $getProduct->getProduct($args);
	}







}
