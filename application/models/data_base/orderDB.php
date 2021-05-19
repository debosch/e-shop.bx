<?php

namespace Team\Models\DB;

use \Team\Core\Model;

class OrderDB extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function sendOrder($item_id = [], $name = '', $email = '', $phone = '')
	{
		$sth = $this->db->prepare(
			"INSERT INTO user (NAME, EMAIL, PHONE)
                                                VALUES (:name, :email, :phone)"
		);
		$sth->bindParam(':name', $name);
		$sth->bindParam(':email', $email);
		$sth->bindParam(':phone', $phone);
		$sth->execute();
		$sth->closeCursor();

		$sth = $this->db->prepare("SELECT MAX(ID) FROM user");
		$sth->execute();
		$maxID = $sth->fetch()[0];
		$sth->closeCursor();

		$date = date('Y-m-d');
		$sth = $this->db->prepare(
			"INSERT INTO orders (USER_ID, CREATION, STATUS)
                                                 VALUES (:user_id, :date, 'new')"
		);
		$sth->bindParam(':user_id', $maxID);
		$sth->bindParam(':date', $date);
		$sth->execute();
		$sth->closeCursor();

		$sth = $this->db->prepare("SELECT MAX(ID) FROM orders");
		$sth->execute();
		$maxID = $sth->fetch()[0];
		$sth->closeCursor();

		foreach ($item_id as $key => $value)
		{
			$sth = $this->db->prepare(
				"INSERT INTO orders_item (ORDER_ID, ITEM_ID, AMOUNT) 
                                          VALUES (:order_id, :item_id, :amount)"
			);
			$sth->bindParam(':order_id', $maxID);
			$sth->bindParam(':item_id', $key);
			$sth->bindParam(':amount', $value);
			$sth->execute();
			$sth->closeCursor();
			$sth->closeCursor();
		}
	}

	public function getOrders($status): array
	{
		if (!isset($status))
		{
			$status = 'new';
		}

		$sth = $this->db->prepare(
			"select ORDER_ID, u.NAME as USERNAME, u.PHONE, u.EMAIL, i.NAME, orders_item.AMOUNT,
                            i.PRICE * orders_item.AMOUNT, o.CREATION
                    from orders_item
		                    inner join orders o on orders_item.ORDER_ID = o.ID
                            inner join item i on orders_item.ITEM_ID = i.ID
		                    inner join user u on o.USER_ID = u.ID
                    where STATUS like '$status'
                    group by ORDER_ID, u.NAME, u.PHONE, u.EMAIL, i.NAME, orders_item.AMOUNT, i.PRICE, o.CREATION;"
		);

		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getOrdersAmount(): array
	{
		$status = 'new';
		$sth = $this->db->prepare("select COUNT(ID) from orders where STATUS = :status");
		$sth->bindParam(':status',$status);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_NUM)[0];
	}

	public function getOrdersTable($status): array
	{
		$sth = $this->db->prepare(
			"SELECT orders.ID, u.NAME as USERNAME, u.PHONE, u.EMAIL, CREATION, MODIFY FROM orders
				inner join user u on orders.USER_ID = u.ID
				where STATUS = :status
				group by orders.ID, u.NAME, u.PHONE, u.EMAIL, CREATION;"
		);
		$sth->bindParam(":status", $status);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function getItemsByOrder($id): array
	{
		$sth = $this->db->prepare(
			"SELECT i.NAME, i.AMOUNT, i.PRICE FROM orders_item
				inner join item i on orders_item.ITEM_ID = i.ID
				where ORDER_ID = :id"
		);
		$sth->bindParam(":id", $id);
		$sth->execute();

		return $sth->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function changeOrderStatus($orderId, $orderStatus)
	{
		$date = date("Y-m-d");
		$sth = $this->db->prepare("UPDATE orders SET STATUS = :status, MODIFY = :date WHERE ID = :order_id");
		$sth->bindParam(":status", $orderStatus);
		$sth->bindParam(":date", $date);
		$sth->bindParam(":order_id", $orderId);
		$sth->execute();
	}

	public function getUserData($orderId): array
	{
		$sth = $this->db->prepare(
			"SELECT u.NAME, u.EMAIL FROM orders
				inner join user u on orders.USER_ID = u.ID
				where orders.ID = :id"
		);
		$sth->bindParam(":id", $orderId);
		$sth->execute();
		return $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
	}
	public function checkOrderId($orderId)
	{
		$sth = $this->db->prepare("SELECT ID FROM orders WHERE ID = :id");
		$sth->bindParam(":id", $orderId);
		$sth->execute();
		return $sth->fetchAll(\PDO::FETCH_ASSOC)[0];
	}
}