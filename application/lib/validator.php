<?php

namespace Team\lib;

class Validator
{
	public function validateEmail($email): bool
	{
		$sanitized_email = filter_var($email, FILTER_SANITIZE_EMAIL);
		if (filter_var($sanitized_email, FILTER_VALIDATE_EMAIL))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	public function validatePhoneNumber($tel): bool
	{

		$tel = preg_replace('/\s|\+|-|\(|\)/', '', $tel);

		if (is_numeric($tel))
		{
			if (strlen($tel) < 5)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
		else
		{
			return false;
		}
	}

	public function validateTag($input_tag): bool
	{
		$db_tag = new \Team\Models\DB\TagDB();
		$tags = $db_tag->getAllTags();

		if (is_array($input_tag))
		{
			for ($i = 0, $iMax = count($input_tag); $i < $iMax; $i++)
			{
				$tmp1 = 0;
				for ($j = 0, $jMax = count($tags); $j < $jMax; $j++)
				{
					if ($input_tag[$i] == $tags[$j]['NAME'])
					{
						++$tmp1;
					}
				}
				if ($tmp1 == 0)
				{
					return false;
				}
			}

			return true;
		}
		if (is_string($input_tag))
		{
			$tmp2 = 0;
			for ($j = 0, $jMax = count($tags); $j < $jMax; $j++)
			{
				if ($input_tag == $tags[$j]['NAME'])
				{
					++$tmp2;
				}
			}
			if ($tmp2 == 0)
			{
				return false;
			}
			else
			{
				return true;
			}
		}
	}

	public function filterText($text)
	{
		$text = trim($text);
		$text = stripslashes($text);
		$text = htmlspecialchars($text);

		return $text;
	}

	public function validateSearch($input)
	{
		if (strlen($input) >= 200)
		{
			return false;
		}
		else
		{
			$test = trim($input);
			$test = strip_tags($test);
			$test = stripslashes($test);
			$test = htmlspecialchars($test);
			$test = preg_replace('|\s+|', ' ', $test);
			$test = preg_replace('/[^%\- a-zа-яё\d]/ui', '', $test);
			$test = preg_replace('|\s+|', ' ', $test);
			if (strcmp($input, $test) === 0)
			{
				return true;
			}

			return false;
		}
	}
}