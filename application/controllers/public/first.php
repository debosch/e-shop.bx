<?php

namespace Team\Controllers\Pub;

use Team\Core\Controller;

/**
 * тестовый класс
 * Class Controller_First
 */
class First extends Controller
{
//	public function action_index($args)
//	{
////		$item = new \Team\Models\Model_Image();
////		$item->addImage('i3-3770','banner.jpg', __DIR__.'/../../public/images');
////		echo PHP_EOL.'1';
//		$item = new \Team\Models\Model_Item();
//		$item->addItem('vape', 300, 'best vape', 'this is the best vape in the world',1,1);
//	}
	//http://team-a-2020/public/catalog/get?category=pro
	//args['category']=>'pro'
	public function get($args)
	{
		$model = new \Team\Models\DB\ImageDB();
		$model->getImageByID(1);
	}
}
