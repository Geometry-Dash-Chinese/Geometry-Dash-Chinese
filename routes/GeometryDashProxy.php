<?php

use App\Http\Controllers\GeometryDashProxyAccountCommentController;
use App\Http\Controllers\GeometryDashProxyAccountDataController;
use App\Http\Controllers\GeometryDashProxyController;
use App\Http\Controllers\GeometryDashProxyGameAccountBindingTokenController;
use Illuminate\Support\Facades\Route;

Route::group([
	'domain' => 'dl.geometrydashchinese.com',
	'as' => 'GeometryDashProxy.'
], function () {
	Route::inertia('/', 'GeometryDashProxy/Home')->name('home');

	Route::group([
		'prefix' => 'tools',
		'as' => 'tools.',
		'middleware' => ['auth']
	], function () {
		Route::inertia('/', 'GeometryDashProxy/Tools/Home')->name('home');

		Route::group([
			'prefix' => 'account',
			'as' => 'account.'
		], function () {
			Route::group([
				'prefix' => 'binding-token',
				'as' => 'binding-token.'
			], function () {
				Route::get('/', [GeometryDashProxyGameAccountBindingTokenController::class, 'renderPage'])->name('create');
				Route::post('/', [GeometryDashProxyGameAccountBindingTokenController::class, 'create'])->name('create.api');
			});
		});
	});

	Route::group([
		'excluded_middleware' => ['web']
	], function () {
		Route::post('/uploadGJAccComment20.php', [GeometryDashProxyAccountCommentController::class, 'proxyUpload'])->name('account.comment.upload');
		Route::post('/getAccountURL.php', [GeometryDashProxyAccountDataController::class, 'getURL'])->name('account.data.url.get');

		Route::group([
			'prefix' => '/account/data'
		], function () {
			Route::any('/', [GeometryDashProxyAccountDataController::class, 'rejectBase'])->name('account.data.base');
			Route::post('/database/accounts/backupGJAccountNew.php', [GeometryDashProxyAccountDataController::class, 'proxySave'])->name('account.data.save');
			Route::post('/database/accounts/syncGJAccountNew.php', [GeometryDashProxyAccountDataController::class, 'proxyLoad'])->name('account.data.load');
		});

		Route::post('/{path}', [GeometryDashProxyController::class, 'proxy'])
			->where('path', '.*')
			->name('proxy');
	});
});