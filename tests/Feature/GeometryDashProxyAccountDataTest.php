<?php

use App\Enums\GeometryDash\AccountDataType;
use App\Enums\GeometryDash\Versions;
use function Pest\Laravel\post;

[$gameVersion, $binaryVersion] = explode(',', Versions::_22->value);

function getBaseUrl(): string
{
	return route('GeometryDashProxy.account.data.base');
}

test('get url', function () use ($gameVersion, $binaryVersion) {
	$url = getBaseUrl();

	post(route('GeometryDashProxy.account.url.get'), [
		'gameVersion' => $gameVersion,
		'binaryVersion' => $binaryVersion,
		'type' => AccountDataType::SAVE->value,
		'accountID' => 71
	])->assertContent($url);
});

test('get url for load', function () use ($gameVersion, $binaryVersion) {
	$url = getBaseUrl();

	post(route('GeometryDashProxy.account.url.get'), [
		'gameVersion' => $gameVersion,
		'binaryVersion' => $binaryVersion,
		'type' => AccountDataType::LOAD->value,
		'accountID' => 71
	])->assertContent($url);
});