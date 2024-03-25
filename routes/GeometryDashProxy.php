<?php

use App\Http\Controllers\GeometryDashProxyController;
use Illuminate\Support\Facades\Route;

Route::group([
	'domain' => 'dl.geometrydashchinese.com',
	'as' => 'GeometryDashProxy.'
], function () {
	Route::inertia('/', 'GeometryDashProxy/Home')->name('home');

	Route::group([
		'excluded_middleware' => ['web']
	], function () {
		Route::post('/{path}', [GeometryDashProxyController::class, 'proxy'])->name('proxy');
		Route::post('/{path}', [GeometryDashProxyController::class, 'proxy'])
			->where('path', '.*')
			->name('proxy');
	});
});