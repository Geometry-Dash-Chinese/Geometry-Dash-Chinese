<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeometryDashAccountDataLoadRequest;
use App\Http\Requests\GeometryDashAccountDataSaveRequest;
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

	public function proxySave(GeometryDashAccountDataSaveRequest $request)
	{
		$data = $request->validated();

		return $this->service->saveToOfficial($data);
	}

	public function proxyLoad(GeometryDashAccountDataLoadRequest $request)
	{
		$data = $request->validated();

		return $this->service->loadFromOfficial($data);
	}
}