<?php

use App\Http\Controllers\GeometryDashProxyService;
use Illuminate\Support\Facades\Route;

Route::group([
	'domain' => 'dl.geometrydashchinese.com',
	'as' => 'GeometryDashProxy.',
	'excluded_middleware' => ['web']
], function () {
	Route::post('/{path}', [GeometryDashProxyService::class, 'proxy'])->name('proxy');
});