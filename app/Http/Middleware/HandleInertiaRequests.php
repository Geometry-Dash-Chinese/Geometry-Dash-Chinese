<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
	public function share(Request $request): array
	{
		return array_merge(parent::share($request), [
			'user' => Auth::user(),

			'current_route' => Route::currentRouteName(),
			'routes' => function () {
				return collect(Route::getRoutes()->getRoutesByName())
					->filter(function ($route) {
						return Str::startsWith($route->getName(), ['GeometryDashChinese', 'GeometryDashChineseServer', 'GeometryDashProxy', 'NewgroundsProxy']);
					});
			}
		]);
	}
}