<?php

namespace Team\Models\Blogic;

class Item
{
	/**
	 * @param $args
	 *
	 * @return string
	 */
	public function addItem($args): string
	{
		$messageError = '';
		$modelAddItem = new \Team\Models\DB\ItemDB();
		$modelTag = new \Team\Models\DB\TagDB();

		/**
		 * блок валидации данных
		 */
		if(!$this->checkForm($args))
		{
			return 'Введены не все обязательные поля формы!';
		}
		if (!empty($modelAddItem->getItemIDByName($args['name'])))
		{
			return 'Данный товар уже существует!';
		}
		$validator = new \Team\lib\Validator();
		if (!$validator->validateTag($args['tag']))
		{
			return 'Ошибка ввода тегов!';
		}


		$image = new \Team\Models\Blogic\Image();
		$imagesId = [];
		if (!empty($_FILES))
		{
			if (count($_FILES['file']) == 1)
			{
				$imagesId = $image->addImage($args['name'], $messageError);
			}
			else
			{
				$imagesId = $image->addImages($args['name'], $messageError);
			}
		}
		if (!empty($messageError))
		{
			return $messageError;
		}
		$modelAddItem->addItem(
			$args['name'],
			$args['price'],
			$args['sd'],
			$args['ld'],
			$args['amount'],
			$args['category']
		);

		$idItem = $modelAddItem->getItemIDByName($args['name']);
		$modelTag = new \Team\Models\DB\TagDB();
		$tagsId = $modelTag->getTagsIDbyNames($args['tag']);
		if (!empty($imagesId))
		{
			$modelAddItem->bindItemWithImage($idItem[0]['ID'], $imagesId);
		}
		$modelAddItem->bindItemWithTag($idItem[0]['ID'], $tagsId);

		return 'success';
	}

	/**
	 *
	 * @param $args
	 *
	 * @return string
	 */
	public function updateItem($args): string
	{
		if(!$this->checkForm($args))
		{
			return 'Введены не все обязательные поля формы!';
		}
		$messageError = '';
		$itemDB = new \Team\Models\DB\ItemDB();
		if (empty($itemDB->getItemById($args['id'])))
		{
			return 'товара под данным id не существует';
		}
		$itemDB->deleteBindItemWithTags($args['id']);

		//обрабатываем полученные изображения
		$modelImage = new \Team\Models\Blogic\Image();
		$imagesId = $modelImage->updateImages($args['id'], $args['name'], $messageError);
		if ($messageError != '')
		{
			return $messageError;
		}
		$itemDB->bindItemWithImage($args['id'], $imagesId);

		$itemDB->updateItem(
			$args['id'],
			$args['name'],
			$args['price'],
			$args['sd'],
			$args['ld'],
			$args['amount'],
			$args['category']
		);

		//обрабатываем полученные теги
		$tagDB = new \Team\Models\DB\TagDB();
		$tagsId = $tagDB->getTagsIDbyNames($args['tag']);
		$itemDB->bindItemWithTag($args['id'], $tagsId);

		return 'success';
	}

	public function test()
	{
		$modelImage = new \Team\Models\DB\ImageDB();
		$imagesId = $modelImage->getImagesByItemID(1);
		var_dump($imagesId);
	}

	private function checkForm($args)
	{
		if ($args['name'] == '' ||
			$args['price'] == '' ||
			$args['amount'] == '' ||
			$args['sd'] == '' ||
			$args['category'] == '')
		{
			return false;
		}
		return true;
	}
}