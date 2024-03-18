<?php

namespace App\Http\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ProxyService
{
	public function instance(): PendingRequest
	{
		return Http::withOptions([
			'proxy' => config('services.proxy.server')
		]);
	}
}