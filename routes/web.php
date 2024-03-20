<?php

use Illuminate\Support\Facades\Route;

require_once 'GeometryDashProxy.php';

Route::inertia('/', 'Home')->name('home');