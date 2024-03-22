<?php

namespace App\Providers;

use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\ServiceProvider;

class GeometryDashChineseCustomizeProvider extends ServiceProvider
{
	public function boot(): void
	{
		Authenticate::redirectUsing(function () {
			return route('GeometryDashChinese.auth.login');
		});
	}
}