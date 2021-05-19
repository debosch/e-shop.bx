<?php

namespace Team\Controllers\Shared;

class GetCatalog
{
	public function getCatalog($args, string $type)
	{
		$this->handlingArgs($args);
		$giat = new \Team\lib\GIaT();
		$fpss = new \Team\lib\FPSS();
		$modelItem = new \Team\Models\DB\ItemDB();

		$arr = $modelItem->getItemsByCategory($args['category']);
		if($type == 'public')
		{
			$arr = $giat->getImagePrev($arr);
		}
		$arr = $giat->getTag($arr);
		$arr = $fpss->filterByPrice($arr, $args['cmin'], $args['cmax']);
		$arr = $fpss->filterByTag($arr, $args['tag']);
		$arr = $fpss->sorting($arr, $args['sort'], $args['revert']);
		$arr = $fpss->pagination($arr,$args['p'],$args['psize']);

		return json_encode($arr);
	}


	private function handlingArgs(&$args)
	{
		if (!array_key_exists('tag', $args) || $args['tag'] == '')
		{
			$args['tag'] = 'none';
		}
		if (!array_key_exists('p', $args) || $args['p'] == '')
		{
			$args['p'] = 1;
		}
		if (!array_key_exists('sort', $args) || $args['sort'] == '')
		{
			$args['sort'] = 'count';
		}
		if (!array_key_exists('revert', $args) || $args['revert'] == '')
		{
			$args['revert'] = 'decrease';
		}
		if (!array_key_exists('psize', $args) || $args['psize'] == '')
		{
			$args['psize'] = 20;
		}
		if (!array_key_exists('cmin', $args) || $args['cmin'] == '')
		{
			$args['cmin'] = 0;
		}
		if (!array_key_exists('cmax', $args) || $args['cmax'] == '')
		{
			$args['cmax'] = PHP_INT_MAX;
		}
	}
}