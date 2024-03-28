<?php

use App\Http\Controllers\GeometryDashChineseAuthController;
use App\Http\Controllers\GeometryDashChineseController;
use App\Http\Controllers\GeometryDashChineseUserController;
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
		Route::get('/login', [GeometryDashChineseAuthController::class, 'renderLogin'])->name('login');
		Route::post('/login', [GeometryDashChineseAuthController::class, 'login'])->name('login.api');

		Route::get('/register', [GeometryDashChineseAuthController::class, 'renderRegister'])->name('register');
		Route::post('/register', [GeometryDashChineseAuthController::class, 'register'])->name('register.api');
	});

	Route::group([
		'prefix' => '/user',
		'as' => 'user.',
		'middleware' => ['auth']
	], function () {
		Route::inertia('/profile', 'GeometryDashChinese/User/Profile')->name('profile');
	});
});