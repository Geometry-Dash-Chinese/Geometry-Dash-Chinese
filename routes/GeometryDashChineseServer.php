<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'domain' => 'gf.geometrydashchinese.com',
	'as' => 'GeometryDashChineseServer.'
], function () {
	Route::inertia('/', 'GeometryDashChineseServer/Home')->name('home');
});