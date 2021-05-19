<?php

namespace Team\Core;

class Model
{
	protected $db;

	public function __construct()
	{
		$this->db = Database::getInstance();
	}

	public function get_data()
	{
	}
}

