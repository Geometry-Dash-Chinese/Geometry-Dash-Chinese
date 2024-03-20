<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class GeometryDashChineseController extends Controller
{
	public function renderHome()
	{
		return Inertia::render('Home', [
			'links' => [
				'GeometryDashChinese' => route('GeometryDashChinese.home'),
				'GeometryDashChineseServer' => route('GeometryDashChineseServer.home'),
				'GeometryDashProxy' => route('GeometryDashProxy.home'),
				'NewgroundsProxy' => route('NewgroundsProxy.home')
			]
		]);
	}
}
