<?php

use Illuminate\Support\Facades\Route;

require_once 'GeometryDashChineseServer.php';
require_once 'GeometryDashProxy.php';
require_once 'NewgroundsProxy.php';

Route::group([
	'domain' => 'geometrydashchinese.com',
	'as' => 'GeometryDashChinese.'
], function () {
	Route::inertia('/', 'Home')->name('home');
});