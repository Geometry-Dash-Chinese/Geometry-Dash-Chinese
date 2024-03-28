<?php

namespace App\Http\Services;

use Base64Url\Base64Url;

class GeometryDashAlgorithmService
{
	public function encode(string $data, string $key, bool $usePadding = true, bool $sha1 = true): string
	{
		return Base64Url::encode($this->xor($sha1 ? sha1($data) : $data, $key), $usePadding);
	}

	public function xor(string $data, string $key): string
	{
		$dataChars = str_split($data);
		$keyChars = str_split($key);

		$data = array_map('ord', $dataChars);
		$key = array_map('ord', $keyChars);

		$result = null;
		foreach ($data as $i => $v) {
			$keyCount = count($key);
			$result .= chr($v ^ $key[$i % $keyCount]);
		}

		return $result;
	}

	public function decode(string $data, string $key): string
	{
		return $this->xor(Base64Url::decode($data), $key);
	}
}