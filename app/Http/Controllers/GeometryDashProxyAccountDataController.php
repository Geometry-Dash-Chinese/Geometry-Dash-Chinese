<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeometryDashGameAccountDataLoadRequest;
use App\Http\Requests\GeometryDashGameAccountDataSaveRequest;
use App\Http\Services\GeometryDashProxyAccountDataService;

class GeometryDashProxyAccountDataController extends Controller
{
	public function __construct(
		protected GeometryDashProxyAccountDataService $service
	)
	{

	}

	public function rejectBase()
	{
		abort(404);
	}

	public function getURL()
	{
		return route('GeometryDashProxy.account.data.base');
	}

	public function proxySave(GeometryDashGameAccountDataSaveRequest $request)
	{
		$data = $request->validated();

		return $this->service->saveToOfficial($data);
	}

	public function proxyLoad(GeometryDashGameAccountDataLoadRequest $request)
	{
		$data = $request->validated();

		return $this->service->loadFromOfficial($data);
	}
}