<?php

use Illuminate\Support\Facades\Route;

Route::group([
	'domain' => 'ng.geometrydashchinese.com',
	'as' => 'NewgroundsProxy.'
], function () {
	Route::inertia('/', 'NewgroundsProxy/Home')->name('home');
});