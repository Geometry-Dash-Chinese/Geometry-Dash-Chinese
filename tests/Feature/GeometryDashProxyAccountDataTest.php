<?php

use App\Enums\GeometryDashAccountDataType;
use App\Enums\GeometryDashVersions;
use function Pest\Laravel\post;

[$gameVersion, $binaryVersion] = explode(',', GeometryDashVersions::_22->value);

test('get url for save', function () use ($gameVersion, $binaryVersion) {
	post(route('GeometryDashProxy.account.data.url.get'), [
		'gameVersion' => $gameVersion,
		'binaryVersion' => $binaryVersion,
		'type' => GeometryDashAccountDataType::SAVE->value,
		'accountID' => 71
	])->assertContent(route('GeometryDashProxy.account.data.base'));
});

test('get url for load', function () use ($gameVersion, $binaryVersion) {
	post(route('GeometryDashProxy.account.data.url.get'), [
		'gameVersion' => $gameVersion,
		'binaryVersion' => $binaryVersion,
		'type' => GeometryDashAccountDataType::LOAD->value,
		'accountID' => 71
	])->assertContent(route('GeometryDashProxy.account.data.base'));
});