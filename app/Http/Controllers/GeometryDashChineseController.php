<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class GeometryDashChineseController extends Controller
{
	public function __construct()
	{
		Inertia::share([
			'user' => Auth::user(),
			'current_route' => Route::currentRouteName(),
			'links' => [
				'GeometryDashChinese' => route('GeometryDashChinese.home'),
				'GeometryDashChineseServer' => route('GeometryDashChineseServer.home'),
				'GeometryDashProxy' => route('GeometryDashProxy.home'),
				'NewgroundsProxy' => route('NewgroundsProxy.home'),

				'AuthLogin' => route('GeometryDashChinese.auth.login'),
				'AuthRegister' => route('GeometryDashChinese.auth.register'),

				'UserProfile' => route('GeometryDashChinese.user.profile'),
				'UserLogoutApi' => route('GeometryDashChinese.user.logout.api')
			]
		]);
	}

	public function renderHome()
	{
		return Inertia::render('GeometryDashChinese/Home');
	}
}