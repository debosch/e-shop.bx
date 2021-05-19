<?php

namespace Team\Models\DB;

use Team\Core\Model;

class ItemDB extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function addItem($name = '', $price = 0, $shortDescription = '', $longDescription = '', $amount = 0,
							$category = '')
	{
		$stm = $this->db->prepare(
			"INSERT INTO ITEM (NAME , PRICE, SHORT_DESCRIPTION, LONG_DESCRIPTION, CREATION,
                   AMOUNT, CATEGORY) 
		VALUES (:name, :price, :s_descr, :l_descr, :creation, :amount, :category)"
		);
		$date = date("Y-m-d");
		$stm->bindParam(':name', $name);
		$stm->bindParam(':price', $price);
		$stm->bindParam(':s_descr', $shortDescription);
		$stm->bindParam(':l_descr', $longDescription);
		$stm->bindParam(':creation', $date);
		$stm->bindParam(':amount', $amount);
		$stm->bindParam(':category', $category);
		$stm->execute();
	}

	public function getItems($limit = 0): array
	{
		if ($limit !== 0)
		{
			$sth = $this->db->prepare("SELECT * FROM  item LIMIT = $limit");
		}
		else
		{
			$sth = $this->db->prepare("SELECT * FROM  item");
		}

		$sth->execute();

		if ($sth->rowCount() === 0)
		{
			return [];
		}

		return $sth->fetchAll();
	}

	public function getItemsByCategory($category, $limit = 0): array
	{
		if ($limit !== 0)
		{
			$sth = $this->db->prepare(
				"SELECT ID, NAME, PRICE,  AMOUNT FROM item WHERE item.CATEGORY = $category LIMIT = :limit"
			);
			$sth->bindParam(':category', $category);
			$sth->bindParam(':limit', $limit);
		}
		else
		{
			$sth = $this->db->prepare(
				"SELECT ID, NAME, PRICE, AMOUNT FROM item WHERE item.CATEGORY = :category"
			);
			$sth->bindParam(':category', $category);
		}

		$sth->execute();

		if ($sth->rowCount() === 0)
		{
			return [];
		}

		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}


    /**
     * @param string $name Имя товара
     * @param int $limit Ограничение количества товаров
     * Функция получения товаров по имени
     * @return array
     */

	public function getItemsByName($name, $limit = 0): array
	{
		$safeName = htmlspecialchars($name);
		if (is_integer($limit) && $limit > 0)
		{
			$sth = $this->db->prepare(
				"SELECT * FROM item WHERE item.NAME LIKE ".$this->explodeQuery($safeName)."LIMIT = $limit"
			);
			$sth->execute();

			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}
		else if (is_integer($limit) && $limit === 0)
		{
			$sth = $this->db->prepare("SELECT * FROM item WHERE item.NAME LIKE ".$this->explodeQuery($safeName));
			$sth->execute();

			return $sth->fetchAll(\PDO::FETCH_ASSOC);
		}

		return [];
	}

	/**
     * @param string $query Входящий запрос
     * Функция для разбивания запроса на отдельные слова
     * @return string
     */

	private function explodeQuery($query): string
	{
		$expQuery = explode(' ', $query);
		$result = "'%{$expQuery[0]}%'";
		for ($i = 1; $i < count($expQuery); $i++)
		{
			$result = $result." OR '%"."{$expQuery[$i]}"."%'";
		}

		return $result;
	}

	/**
	 * получаем товар по его id
	 *
	 * @param $id
	 *
	 * @return array
	 */
	public function getItemById($id): array
	{
		$sth = $this->db->prepare("SELECT * FROM item WHERE item.ID = :id");
		$sth->bindParam(':id', $id);
		$sth->execute();

		if ($sth->rowCount() === 0)
		{
			return [];
		}

		return $sth->fetchAll()[0];
	}

	public function deleteItem($id): bool

	{
		$sth = $this->db->prepare("DELETE FROM item WHERE item.ID = $id");
		$sth->execute();

		if ($sth->rowCount() === 0)
		{
			return false;
		}

		return true;
	}

	/**
	 * Влад прокомментируй метод
	 *
	 * @param $items
	 */
	public function decreaseItemAmount($items)
	{
		foreach ($items as $key => $value)
		{
			$sth = $this->db->prepare("UPDATE item SET item.AMOUNT = item.AMOUNT - $value WHERE item.ID = $key");
			$sth->execute();
			$sth->closeCursor();
		}
	}

	/**
	 * получаем товар по его имени в БД
	 *
	 * @param $name
	 *
	 * @return array
	 */
	public function getItemIDByName($name)
	{
		$sth = $this->db->prepare("SELECT ID FROM item WHERE item.NAME = :name");
		$sth->bindParam(':name', $name);
		$sth->execute();

		return $sth->fetchAll();
	}

	/**
	 * получаем количество экземпляров товара по его id
	 *
	 * @param $id
	 *
	 * @return mixed
	 */
	public function getTotalAmount($id)
	{
		$sth = $this->db->prepare("SELECT AMOUNT FROM item WHERE ID=$id");
		$sth->execute();

		return $sth->fetch(\PDO::FETCH_ASSOC);
	}

	/**
	 * создаем внешние ключи между тегами и товаром
	 *
	 * @param $itemId
	 * @param $tagId
	 *
	 * @return bool
	 */
	public function bindItemWithTag($itemId, $tagId)
	{
		if (is_array($tagId))
		{
			for ($i = 0; $i < count($tagId); $i++)
			{
				$sth = $this->db->prepare("INSERT INTO  item_tag (ITEM_ID, TAG_ID) VALUE (:item_id, :tag_id)");
				$sth->bindParam(':item_id', $itemId);
				$sth->bindParam(':tag_id', $tagId[$i]);
				$sth->execute();
			}
		}
		else
		{
			$sth = $this->db->prepare("INSERT INTO  item_tag (ITEM_ID, TAG_ID) VALUE (:item_id, :tag_id)");
			$sth->bindParam(':item_id', $itemId);
			$sth->bindParam(':tag_id', $tagId);
			$sth->execute();
		}

		return true;
	}

	/**
	 * создание внешних ключей между изображениями и товаром
	 *
	 * @param $itemId
	 * @param bool|array $imageId
	 *
	 * @return bool
	 */
	public function bindItemWithImage($itemId, $imageId)
	{
		if (is_array($imageId))
		{
			for ($i = 0; $i < count($imageId); $i++)
			{
				$sth = $this->db->prepare("INSERT INTO  item_image (ITEM_ID, IMAGE_ID) VALUE (:item_id, :image_id)");
				$sth->bindParam(':item_id', $itemId);
				$sth->bindParam(':image_id', $imageId[$i]);
				$sth->execute();
			}
		}
		else
		{
			$sth = $this->db->prepare("INSERT INTO  item_image (ITEM_ID, IMAGE_ID) VALUE (:item_id,  :image_id)");
			$sth->bindParam(':item_id', $itemId);
			$sth->bindParam(':image_id', $imageId[0]);
			$sth->execute();
		}

		return true;
	}

	/**
	 * обновляем запись о товаре по id
	 *
	 * @param $id
	 * @param $name
	 * @param $price
	 * @param $SD
	 * @param $LD
	 * @param $amount
	 * @param $category
	 */
	public function updateItem($id, $name, $price, $SD, $LD, $amount, $category)
	{
		$date = date("Y-m-d");
		$stm = $this->db->prepare(
			"UPDATE ITEM SET NAME = :name ,
                       PRICE = :price ,
                       SHORT_DESCRIPTION = :s_d ,
                       LONG_DESCRIPTION = :l_d ,
                       MODIFY = :mod ,
                       AMOUNT = :amount ,
                       CATEGORY = :category
                       where ID = :id"
		);
		$stm->bindParam(':id', $id);
		$stm->bindParam(':name', $name);
		$stm->bindParam(':price', $price);
		$stm->bindParam(':s_d', $SD);
		$stm->bindParam(':l_d', $LD);
		$stm->bindParam(':mod', $date);
		$stm->bindParam(':amount', $amount);
		$stm->bindParam(':category', $category);
		$stm->execute();
	}

	/**
	 * удаляем внешние ключи между изображениями и товаром
	 *
	 * @param $itemId
	 */
	public function deleteBindItemWithImages($itemId)
	{
		$sth = $this->db->prepare("DELETE FROM item_image WHERE ITEM_ID = :item_id");
		$sth->bindParam("item_id", $itemId);
		$sth->execute();
	}

	/**
	 * удаляем внешние ключи между тегами и товаром
	 *
	 * @param $itemId
	 */
	public function deleteBindItemWithTags($itemId)
	{
		$sth = $this->db->prepare("DELETE FROM item_tag WHERE ITEM_ID = :item_id");
		$sth->bindParam("item_id", $itemId);
		$sth->execute();
	}
}