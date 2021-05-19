<?php

namespace Team\lib;

class GIaT
{
	/**
	 * функция извлекает из базы данных первое изображение каждого товара
	 * если изображения отсутствуют, то добавляет изображение по умолчанию
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	public function getImagePrev(array $data)
	{

		$modelImage = new \Team\Models\DB\ImageDB();
		for ($i = 0; $i < count($data); $i++)
		{
			if (!array_key_exists($i, $data))
			{
				break;
			}
			$path = $modelImage->getImagesByItemID($data[$i]['ID']);
			if (empty($path))
			{
				$path[0]["path"] = "../resource_images/product-image-none.jpg";
			}

			$data[$i]['IMAGE'] = base64_encode(file_get_contents($path[0]["path"]));
		}

		return $data;
	}

	/** функция извлекает из базы данных изображения товара по id
	 *
	 * @param int $id
	 *
	 * @return array
	 */
	public function getImages(int $id)
	{
		$modelImage = new \Team\Models\DB\ImageDB();
		$images = [];
		$path = $modelImage->getImagesByItemID($id);
		if (empty($path))
		{
			$path[0]["path"] = "../resource_images/product-image-none.jpg";
			$images['IMAGE'][0] = base64_encode(file_get_contents($path[0]["path"]));
		}
		else
		{
			for ($j = 0; $j < count($path); $j++)
			{
				$images['IMAGE'][$j] = base64_encode(file_get_contents($path[$j]["path"]));
			}
		}

		return $images;
	}

	public function getTag(array $data)
	{
		$modelImage = new \Team\Models\DB\TagDB();
		for ($i = 0; $i < count($data); $i++)
		{
			if (!array_key_exists($i, $data))
			{
				break;
			}
			$path = $modelImage->getTagByItemID($data[$i]['ID']);
			$data[$i]['TAG'] = $path;
		}

		return $data;
	}

	public function getTagsToProduct(int $id)
	{
		$modelImage = new \Team\Models\DB\TagDB();
		$arr = $modelImage->getTagByItemID($id);
		$data['TAG'] = $arr;

		return $data;
	}
}