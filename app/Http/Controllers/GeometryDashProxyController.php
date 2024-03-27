<?php

namespace App\Http\Controllers;

use App\Http\Services\GeometryDashProxyService;
use Illuminate\Http\Request;

class GeometryDashProxyController extends Controller
{
	public function __construct(
		protected GeometryDashProxyService $service
	)
	{

	}

	public function proxy(Request $request)
	{
		return $this->service->sendPost(
			$request->getRequestUri(),
			$request->all()
		);
	}
}