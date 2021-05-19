<?php

namespace Team\lib;

class FPSS
{
	public function pagination($arr, $page, $pSize): array
	{
		$newArr = [];
		if ($page < 1)
		{
			return $newArr;
		}

		for ($j = 0, $i = $pSize * ($page - 1); $i < $pSize * $page; $i++, $j++)
		{
			if (!array_key_exists($i, $arr))
			{
				break;
			}
			$newArr[$j] = $arr[$i];

		}

		$pageLast = ceil(count($arr) / $pSize);
		//$newArr[0]['plast'] = $pageLast;
		//$newArr['p'] = $page;
		return $newArr;
	}

	public function sorting($data, $param, $comparator): array
	{
		switch ($param)
		{
			case 'alph':
				usort($data, 'Team\Lib\nameSort');
				break;
			case 'cost':
				usort($data, 'Team\Lib\priceSort');
				break;
			case 'count':
				usort($data, 'Team\Lib\amountSort');
				break;
		}
		if ($comparator == 'decrease')
		{
			return array_reverse($data);
		}

		return $data;
	}

	public function filterByPrice($data, $pmin, $pmax)
	{
		if ($pmax < $pmin)
		{
			return $data;
		}
		$array = [];

		for ($i = 0; $i < count($data); $i++)
		{

			if (!array_key_exists($i, $data))
			{
				break;
			}
			if ((int)$data[$i]['PRICE'] >= $pmin && (int)$data[$i]['PRICE'] <= $pmax)
			{
				array_push($array, $data[$i]);
			}
		}
		return $array;
	}

	public function filterByTag($data, $tags)
	{
		if ($tags === 'none')
		{
			return $data;
		}
		$array = [];
		if(empty($tags) || $tags === 'none')
		{
			return $data;
		}
		if (is_array($tags))
		{
			$tmp = 0;

			for ($i = 0; $i < count($data); $i++)
			{
				for ($j = 0; $j < count($tags); $j++)
				{
					for ($k = 0; $k < count($data[$i]['TAG']); $k++)
					{
						if (!array_key_exists($i, $data))
						{
							break;
						}
						if ($data[$i]['TAG'][$k]['tag'] == $tags[$j])
						{
							$tmp++;
						}
					}
					if ($tmp == count($tags))
					{
						array_push($array, $data[$i]);
					}
				}
				$tmp = 0;
			}
		}
		if (is_string($tags))
		{
			$j = 0;
			for ($i = 0; $i < count($data); $i++)
			{
				for ($k = 0; $k < count($data[$i]['TAG']); $k++)
				{
					if (!array_key_exists($i, $data))
					{
						break;
					}
					if ($data[$i]['TAG'][$k]['tag'] == $tags)
					{
						$array[$j] = $data[$i];
						$j++;
					}
				}
			}
		}
		return $array;
	}
}

function nameSort($x, $y)
{
	return strcasecmp($x['NAME'], $y['NAME']);
}

function priceSort($x, $y)
{
	if ($x['PRICE'] > $y['PRICE'])
	{
		return true;
	}
	else
	{
		return false;
	}

}

function amountSort($x, $y)
{
	if ($x['AMOUNT'] > $y['AMOUNT'])
	{
		return true;
	}
	else
	{
		return false;
	}
}

