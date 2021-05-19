<?php

namespace Team\Models\DB;

use Team\Core\Model;

class ImageDB extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addImage($name = '', $fileName = '', $path = '')
	{
		$this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		$stm = $this->db->prepare(
			"INSERT INTO image (NAME , FILE_NAME, PATH) 
		VALUES (:name, :fileName, :path)"
		);
		$stm->bindParam(':name', $name);
		$stm->bindParam(':fileName', $fileName);
		$stm->bindParam(':path', $path);
		$stm->execute();

	}

	public function getMaxImageID()
	{
		$sth = $this->db->prepare("SELECT MAX(ID) FROM image");
		$sth->execute();

		return $sth->fetchAll()[0][0];
	}

	public function getImagesByItemID($itemId)
	{
		$paths = [];
		$imagesId = $this->getImagesIDByItemID($itemId);
		for ($i = 0; $i < count($imagesId); $i++)
		{
			$sth = $this->db->prepare("SELECT NAME, FILE_NAME, PATH FROM image WHERE image.ID = :id");
			$sth->bindParam(':id', $imagesId[$i][0]);
			$sth->execute();
			$arr = $sth->fetchAll()[0];
			$paths[$i]['path'] = $arr['PATH'].$arr['FILE_NAME'];

		}

		return $paths;
	}

	public function getImagesIDByItemID($itemId)
	{
		$sth = $this->db->prepare("SELECT IMAGE_ID FROM item_image WHERE item_image.ITEM_ID = :id");
		$sth->bindParam(':id', $itemId);
		$sth->execute();

		return $sth->fetchAll();
	}

	public function deleteImagesFromDB($itemId)
	{
		$paths = [];
		$imagesId = $this->getImagesIDByItemID($itemId);
		$itemDB = new \Team\Models\DB\ItemDB();
		$itemDB->deleteBindItemWithImages($itemId);
		for ($i = 0; $i < count($imagesId); $i++)
		{
			$this->deleteImage($imagesId[$i][0]);
		}
	}

	private function deleteImage($imageId)
	{
		$sth = $this->db->prepare("DELETE FROM image WHERE ID = :id");
		$sth->bindParam(':id', $imageId);
		$sth->execute();
	}

}