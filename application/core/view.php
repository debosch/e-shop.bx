<?php

namespace Team\Core;

class View
{
	//public $template_view; // здесь можно указать общий вид по умолчанию.
	/**
	 * @param $content_view
	 * @param $template_view
	 * @param null $data
	 */

	function generate($content_view, $template_view, $data = null)
	{
		require_once __DIR__.'/../../public/views/template/'.$template_view;
	}
}