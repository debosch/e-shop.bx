<?php

namespace Team\Controllers\Shared;

use Team\Core\Controller;

class GetItem extends Controller
{
	public function getProduct($args)
	{
		$arr = [];
		if (!isset($args["id"]))
		{
			//404page
			return false;
		}
		$this->model = new \Team\Models\DB\ItemDB();
		$arr = $this->model->getItemById($args["id"]);
		if (empty($arr))
		{
			//404page
			return false;
		}
		$giat = new \Team\lib\GIaT();
		$arr += $giat->getImages($arr['ID']);
		$arr += $giat->getTagsToProduct($arr['ID']);
		$json_str = json_encode($arr);

		return $json_str;
	}
}