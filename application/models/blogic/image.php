<?php

namespace Team\Models\Blogic;

class Image
{
	private $fileExtension;
	/**
	 * @var \Team\Models\DB\ImageDB
	 */
	private $model;

	/**
	 * Получает изображения из _FILES,
	 * Добавляет в БД,
	 * возвращает id изображений в виде массива
	 * либо false, при неудаче
	 *
	 * @param string $itemName
	 * @param $message
	 *
	 * @return bool|array
	 */
	public function addImages($itemName = '', &$message)
	{
		$uploadDir = '../resource_images/';
		$imagesId = [];

		foreach ($_FILES['file']["error"] as $key => $error)
		{
			if ($error == UPLOAD_ERR_OK)
			{
				if (!$this->validateImage($_FILES['file']['name'][$key], $_FILES['file']['tmp_name'][$key]))
				{
					$message = 'Обнаружена угроза. Файлы не добавлены';

					return $imagesId;
				}

				$name = $this->hashingName($itemName, $key)."$this->fileExtension";
				if ($_FILES['file']['size'][$key] >= 1048576)
				{
					$this->resizePhoto(
						$uploadDir,
						$name,
						$_FILES['file']['type'][$key],
						$_FILES['file']['tmp_name'][$key]
					);

					$this->model = new \Team\Models\DB\ImageDB();
					$this->model->addImage($itemName."-$key".$this->fileExtension, $name, $uploadDir);
					$imagesId[$key] = $this->model->getMaxImageID();
				}
				else
				{
					$uploadFile = $uploadDir.$name;
					if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $uploadFile))
					{
						$this->model = new \Team\Models\DB\ImageDB();
						$this->model->addImage($itemName."-$key".$this->fileExtension, $name, $uploadDir);
						$imagesId[$key] = $this->model->getMaxImageID();
					}
				}
			}
		}

		return $imagesId;

	}

	/**
	 * Получает изображение из _FILES,
	 * Добавляет в БД,
	 * возвращает id изображения в виде массива
	 * либо false, при неудаче
	 *
	 * @param string $itemName
	 * @param $message
	 *
	 * @return bool|array
	 */
	public function addImage($itemName = '', &$message)
	{
		$uploadDir = '../resource_images/';
		$imagesId = [];

		if ($_FILES['file']['error'] == UPLOAD_ERR_OK)
		{
			if (!$this->validateImage($_FILES['file']['name'], $_FILES['file']['tmp_name']))
			{
				$message = 'Обнаружена угроза. Файлы не добавлены';

				return $imagesId;
			}

			$name = $this->hashingName($itemName, 1)."$this->fileExtension";
			if ($_FILES['file']['size'] >= 1048576)
			{
				$this->resizePhoto($uploadDir, $name, $_FILES['file']['type'], $_FILES['file']['tmp_name']);
				$this->model = new \Team\Models\DB\ImageDB();
				$this->model->addImage($itemName."-1".$this->fileExtension, $name, $uploadDir);
				$imagesId[0] = $this->model->getMaxImageID();
			}
			else
			{
				$uploadFile = $uploadDir.$name;
				if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile))
				{
					$this->model = new \Team\Models\DB\ImageDB();
					$this->model->addImage($itemName."-1".$this->fileExtension, $name, $uploadDir);
					$imagesId[0] = $this->model->getMaxImageID();
				}
			}
		}
		return $imagesId;

	}

	private function validateImage($name, $tmpName)
	{
		if (!$this->checkMIMEType($tmpName) || !$this->checkWhiteList($name))
		{
			return false;
		}

		return true;
	}

	/**
	 * Проверка на MIME-тип
	 * возвращает false, если mime-тип не является изображением
	 *
	 * @param $image
	 *
	 * @return bool
	 */
	private function checkMIMEType($image): bool
	{
		$imageInfo = getimagesize($image);
		if ($imageInfo['mime'] != 'image/png' && $imageInfo['mime'] != 'image/jpeg')
		{
			echo "Sorry, we only accept GIF and JPEG images\n";

			return false;
		}

		return true;
	}

	/**
	 * проверяет расширение файла по белому списку расширений
	 *
	 * @param $name
	 *
	 * @return bool
	 */
	private function checkWhiteList($name)
	{
		$blacklist = [".jpg", ".jpeg", ".png"];
		foreach ($blacklist as $item)
		{
			if (preg_match("/$item\$/i", $name))
			{
				$this->fileExtension;

				return true;
			}
		}
		echo "We do not allow uploading PHP files\n";

		return false;
	}

	/**
	 * хеширует название файла
	 *
	 * @param $name
	 *
	 * @param $key
	 *
	 * @return string
	 */
	private function hashingName($name, $key)
	{
		$time = date("Y-m-d-H-i-s");

		return $name.$time."-$key";
	}

	/**
	 * редактируем изображения товара
	 * 1. получаем пути до прошлых изображений
	 * если не пустые то:
	 *    2. удаляем старые изображения с сервера
	 *    3. удаляем связи с старыми изображениями
	 *    4. удаляем записи из бд о изображениях
	 * 5. добавляем новые изображения
	 *
	 * @param $itemId
	 * @param $itemName
	 *
	 * @return array
	 */

	public function updateImages($itemId, $itemName, &$messageError)
	{
		$imageDB = new \Team\Models\DB\ImageDB();
		$imagesPaths = $imageDB->getImagesByItemID($itemId);

		if (!empty($imagesPaths))
		{
			$this->deleteImagesFromServer($imagesPaths);

			$imageDB->deleteImagesFromDB($itemId);
		}

		$imagesId = [];
		if (!empty($_FILES))
		{
			if (count($_FILES['file']) == 1)
			{
				$imagesId = $this->addImage($itemName, $messageError);
			}
			else
			{
				$imagesId = $this->addImages($itemName, $messageError);
			}
		}

		return $imagesId;
	}

	/**
	 * удаления изображений с сервера
	 *
	 * @param $paths
	 */
	private function deleteImagesFromServer($paths)
	{
		for ($i = 0, $iMax = count($paths); $i < $iMax; $i++)
		{
			unlink($paths[$i]['path']);
		}
	}

	private function resizePhoto($path, $filename, $type, $tmp_name)
	{
		$quality = 60; //Качество в процентах. В данном случае будет сохранено 60% от начального качества.
		switch ($type)
		{
			case 'image/jpeg':
			case 'image/jpg':
				$source = imagecreatefromjpeg($tmp_name);
				break;
			//Создаём изображения по
			case 'image/png':
				$source = imagecreatefrompng($tmp_name);
				break;  //образцу загруженного
			case 'image/gif':
				$source = imagecreatefromgif($tmp_name);
				break; //исходя из его формата
			default:
				return false;
		}
		imagejpeg(
			$source,
			$path.$filename,
			$quality
		); //Сохраняем созданное изображение по указанному пути в формате jpg
		imagedestroy($source);//Чистим память
	}
}