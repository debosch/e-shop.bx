<?php
namespace Team\Controllers\Admin;

use Team\Core\Controller;

class Logout extends Controller
{
	public function action()
	{
		$modelLogout = new \Team\Models\Blogic\Logout();
		$modelLogout->action();
	}
}
