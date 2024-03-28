<?php

use App\Http\Controllers\GeometryDashChineseAuthController;
use Illuminate\Support\Facades\Route;

Route::group([
	'domain' => 'geometrydashchinese.com',
	'as' => 'GeometryDashChinese.'
], function () {
	Route::inertia('/', 'GeometryDashChinese/Home')->name('home');

	Route::group([
		'prefix' => 'auth',
		'as' => 'auth.',
		'middleware' => ['guest']
	], function () {
		Route::inertia('/login', 'GeometryDashChinese/Auth/Login')->name('login');
		Route::post('/login', [GeometryDashChineseAuthController::class, 'login'])->name('login.api');

		Route::inertia('/register', 'GeometryDashChinese/Auth/Register')->name('register');
		Route::post('/register', [GeometryDashChineseAuthController::class, 'register'])->name('register.api');
	});

	Route::group([
		'prefix' => '/user',
		'as' => 'user.',
		'middleware' => ['auth']
	], function () {
		Route::inertia('/profile', 'GeometryDashChinese/User/Profile')->name('profile');
		Route::get('/logout', [GeometryDashChineseAuthController::class, 'logout'])->name('logout.api');
	});
});