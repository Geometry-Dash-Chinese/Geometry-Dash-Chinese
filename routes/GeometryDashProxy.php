<?php

use App\Http\Controllers\GeometryDashProxyAccountDataController;
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
		Route::post('/getAccountURL.php', [GeometryDashProxyAccountDataController::class, 'getURL'])->name('account.url.get');

		Route::group([
			'prefix' => '/accounts',
			'as' => 'account.'
		], function () {
			Route::group([
				'prefix' => '/data',
				'as' => 'data.'
			], function () {
				Route::any('/', [GeometryDashProxyAccountDataController::class, 'rejectBase'])->name('base');
				Route::post('/database/accounts/backupGJAccountNew.php', [GeometryDashProxyAccountDataController::class, 'proxySave'])->name('save');
				Route::post('/database/accounts/syncGJAccountNew.php', [GeometryDashProxyAccountDataController::class, 'proxyLoad'])->name('load');
			});
		});

		Route::post('/{path}', [GeometryDashProxyController::class, 'proxy'])
			->where('path', '.*')
			->name('proxy');
	});
});