<?php

namespace Team\Controllers\Admin;

use Team\Core\Controller;

class Catalog extends Controller
{
	public function get($args)
	{
		\Team\Models\Blogic\Auth::isAuth();
		$catalog = new \Team\Controllers\Shared\GetCatalog();
		echo $catalog->getCatalog($args, 'admin');
	}

	public function updateItem()
	{
		if (empty($_POST))
		{
			exit("Данные не пришли");
		}
		$item = new \Team\Models\Blogic\Item();
		echo  $item->updateItem($_POST);
	}

	public function addItem()
	{
		$args = '';
		$imagesId = [];
		if (empty($_POST))
		{
			echo 'Данные не пришли';
			exit();
		}
		$item = new \Team\Models\Blogic\Item();
		echo $item->addItem($_POST);
	}

	public function getItem($args)
	{
		$item = new \Team\Controllers\Shared\GetItem();
		echo $item->getProduct($args);
	}

}