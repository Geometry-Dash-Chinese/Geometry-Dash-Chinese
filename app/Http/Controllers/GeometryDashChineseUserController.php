<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class GeometryDashChineseUserController extends Controller
{
	public function __construct()
	{
		app(GeometryDashChineseController::class);
	}

	public function renderProfile()
	{
		return Inertia::render('GeometryDashChinese/User/Profile', [
			'user' => Auth::user()
		]);
	}
}