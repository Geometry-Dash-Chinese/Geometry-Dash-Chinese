<?php

use App\Enums\GeometryDashSecrets;
use App\Enums\GeometryDashVersions;
use function Pest\Laravel\post;

[$gameVersion, $binaryVersion] = explode(',', GeometryDashVersions::_22->value);

test('proxy', function () use ($gameVersion, $binaryVersion) {
	$response = post(route('GeometryDashProxy.proxy', ['path' => '/downloadGJLevel22.php']), [
		'gameVersion' => $gameVersion,
		'binaryVersion' => $binaryVersion,
		'levelID' => 128,
		'secret' => GeometryDashSecrets::COMMON->value
	])->content();

	expect($response)->not->toBeNumeric();
});