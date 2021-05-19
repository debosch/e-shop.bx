<?php

namespace Team\Models\DB;

use Team\Core\Model;

class TagDB extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addTag($name = '')
	{
		$stm = $this->db->prepare(
			"INSERT INTO TAG (NAME) 
		VALUES (:name)"
		);
		$stm->bindParam(':name', $name);

		$stm->execute();
	}

	public function getTagsIDbyNames($names)
	{
		$tagsID = [];
		if(is_array($names))
		{
			for ($i =0; $i<count($names);$i++)
			{
				$tmp = $this->getTagIDByName($names[$i]);
				array_push($tagsID, $tmp['ID']);
			}}
		if(is_string($names))
		{
			$tmp = $this->getTagIDByName($names);
			array_push($tagsID, $tmp['ID']);
		}
		return $tagsID;
	}

	public function getTagIDByName(string $name)
	{
		$sth = $this->db->prepare("SELECT ID FROM TAG WHERE TAG.NAME = :name");
		$sth->bindParam(':name', $name);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
	}

	public function getTagByItemID($id)
	{
		$tags = [];
		$arrTags = $this->getTagsIdIDByItemID($id);

		for ($i = 0; $i < count($arrTags); $i++)
		{
			$sth = $this->db->prepare("SELECT NAME FROM tag WHERE tag.ID = :id");
			$sth->bindParam(':id', $arrTags[$i][0]);
			$sth->execute();
			$arr = $sth->fetchAll();
			$tags[$i]['tag'] = $arr[0]['NAME'];
		}
		return $tags;
	}

	private function getTagsIdIDByItemID($id)
	{
		$sth = $this->db->prepare("SELECT TAG_ID FROM item_tag WHERE item_tag.ITEM_ID = :id");
		$sth->bindParam(':id', $id);
		$sth->execute();

		return $sth->fetchAll();
	}

	public function getAllTags() {
		$sth = $this->db->prepare("SELECT NAME FROM tag");
		$sth->execute();
		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}
}