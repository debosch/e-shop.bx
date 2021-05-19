<?php

namespace Team\Core;

use Exception;

class Router
{
	private $space;
	private $path;
	private $controllerName;
	private $actionName;
	private $args = '';
	private $error;

	function __construct()
	{
		$this->controllerName = 'Team\Controllers\Pub\Main';
		$this->actionName = 'index';
	}

	public function start()
	{
		$url = $_SERVER['REQUEST_URI'];
		$error = false;
		if (strpos($url, '?') !== false)
		{

			$url = explode('?', $_SERVER['REQUEST_URI']);

			$this->args = $url[1];
			$url = $url[0];
		}

		$routes = explode('/', $url);

		//парсим контроллер
		$this->getController($routes,$error);

		//парсим аргументы get-запроса
		$this->getParams($this->args);

		// создаем контроллер
		if (!class_exists($this->controllerName))
		{
			Errors::e404();
			return;
		}
		$controller = new $this->controllerName;
		$action = $this->actionName;
		if (method_exists($controller, $action))
		{
			$controller->$action($this->args);
		}
		else
		{
			// здесь выкидываем исключение
			Errors::e404();
		}
	}

	private function getParams($params)
	{
		$arr = [];
		/*
		 * если есть несколько аргументов, то разбиваем строку на массив
		 */
		if ($params !== '' && strpos($params, '&') !== false)
		{
			$params = explode('&', $params);
		}

		if (!is_string($params))
		{
			for ($i = 0; $i < count($params); $i++)
			{
				//				print_r($params[$i].PHP_EOL);
				$tmpArr = [];
				if (strpos($params[$i], '=') !== false)
				{
					$tmp = explode('=', $params[$i]);
					if (!empty($tmp[1]))
					{
						$tmpArr[$tmp[0]] = $tmp[1];
					}
					else
					{
						$tmpArr[$tmp[0]] = '';
					}
				}
				$arr = array_merge_recursive($arr, $tmpArr);
			}
		}
		elseif (is_string($params))
		{
			if (strpos($params, '=') !== false)
			{
				$tmp = explode('=', $params);
				if (!empty($tmp[1]))
				{
					$arr[$tmp[0]] = $tmp[1];
				}
				else
				{
					$arr[$tmp[0]] = '';
				}
			}
		}
		$this->args = $arr;
	}

	private function getController(array $routes, &$error)
	{
		if ($routes[1] == '')
		{
			return;
		}
		$this->error = true;
		if ($routes[1] == 'admin')
		{
			$this->getAdminController($routes);
		}
		else
		{
			$this->getPublicController($routes);
		}

	}

	private function getAdminController(array $routes)
	{
		if (!empty($routes[2]))
		{
			$this->controllerName = $routes[2];
		}
		// получаем имя экшена
		if (!empty($routes[3]))
		{
			$this->actionName = $routes[3];
		}
		$this->controllerName = 'Team\Controllers\Admin\\'.$this->controllerName;
	}

	private function getPublicController(array $routes)
	{
		if (!empty($routes[1]))
		{
			$this->controllerName = $routes[1];
		}
		// получаем имя экшена
		if (!empty($routes[2]))
		{
			$this->actionName = $routes[2];
		}
		$this->controllerName = 'Team\Controllers\Pub\\'.$this->controllerName;
	}
}

