<?php
// Singleton (подключение к MySQL)
namespace Team\Core;

use PDO;

require_once '../config/database.php';



/**
 * Базовый класс для подключения, для дальнейшего наследования
 */
class Database
{

	private static $instance;

	private function __construct()
	{
	}

	private function __clone()
	{
	}

	private function __wakeup()
	{
	}

	public static function getInstance()
	{
		if (self::$instance !== null)
		{
			return self::$instance;
		}

		return self::$instance = new PDO(
			'mysql:host='.DB_HOST.';dbname='.DB_NAME,
			DB_USER,
			DB_PASS,
			[PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
		);
	}
}