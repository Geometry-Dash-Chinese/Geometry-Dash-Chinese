<?php

use App\Http\Controllers\GeometryDashChineseController;
use Illuminate\Support\Facades\Route;

require_once 'GeometryDashChineseServer.php';
require_once 'GeometryDashProxy.php';
require_once 'NewgroundsProxy.php';

Route::group([
	'domain' => 'geometrydashchinese.com',
	'as' => 'GeometryDashChinese.'
], function () {
	Route::get('/', [GeometryDashChineseController::class, 'renderHome'])->name('home');
});