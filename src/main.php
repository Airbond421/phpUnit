<?php

/**
 * @param string $input
 *
 * @return bool
 * @throws Exception for empty input
 */
function isParenthesisValid(string $input = ''): bool
{
	if (!$input)
	{
		throw new EmptyLine();
	}

	$stack = [];
	$validPairs = [
		'(' => ')',
		'[' => ']',
		'{' => '}',
		'<' => '>',
	];

	$strlen = strlen($input);
	for ($i = 0; $i < $strlen; $i++)
	{
		$char = $input[$i];

		if (array_key_exists($char, $validPairs))
		{
			$stack[] = $char;
		}

		if (in_array($char, array_values($validPairs)))
		{
			if (empty($stack) || $validPairs[array_pop($stack)] !== $char)
			{
				return false;
			}
		}
	}

	return empty($stack);
}
