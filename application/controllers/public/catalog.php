<?php

namespace Team\Controllers\Pub;

use Team\Core\Controller;

class Catalog extends Controller
{

	public function index($args)
	{
		$this->view->generate('public_main.php', 'template_public.php');
	}

	public function show()
    {
        $this->view->generate('public_catalog.php', 'template_public.php');
    }

    public function search($args)
    {
		$giat = new \Team\lib\GIaT();
		$fpss = new \Team\lib\FPSS();
		$item = new \Team\Models\DB\ItemDB();
		$validator = new \Team\lib\Validator();
		$message = $validator->validateSearch($args['item']);
		if ($message === false)
		{
			echo 'Некорректный запрос';

			return;
		}
		$arr = $item->getItemsByName(urldecode($args['item']));

		$arr = $giat->getImagePrev($arr);

		echo json_encode($arr);
	}

	public function get($args)
	{
		$catalog = new \Team\Controllers\Shared\GetCatalog();
		echo $catalog->getCatalog($args, 'public');
	}

	public function getTags() {
		$tag = new \Team\Models\DB\TagDB();
		echo json_encode($tag->getAllTags());
	}
}