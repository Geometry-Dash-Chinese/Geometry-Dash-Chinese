<?php

use App\Enums\GeometryDash\Secrets;
use App\Enums\GeometryDash\Versions;
use function Pest\Laravel\post;

[$gameVersion, $binaryVersion] = explode(',', Versions::_22->value);

test('proxy', function () use ($gameVersion, $binaryVersion) {
	$response = post(route('GeometryDashProxy.proxy', ['path' => '/downloadGJLevel22.php']), [
		'gameVersion' => $gameVersion,
		'binaryVersion' => $binaryVersion,
		'levelID' => 128,
		'secret' => Secrets::COMMON->value
	])->content();

	expect($response)->not->toBeNumeric();
});