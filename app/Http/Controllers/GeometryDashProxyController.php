<?php

namespace App\Http\Controllers;

use App\Http\Services\ProxyService;
use Illuminate\Http\Request;

class GeometryDashProxyController extends Controller
{
	public function proxy(Request $request)
	{
		$uri = $request->getRequestUri();
		$data = $request->all();

		return app(ProxyService::class)->instance()
			->asForm()
			->withUserAgent(null)
			->retry(3)
			->post(rtrim(config('services.GeometryDashProxy.base'), '/') . $uri, $data)
			->body();
	}
}