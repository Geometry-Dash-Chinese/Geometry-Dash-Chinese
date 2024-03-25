<?php

namespace App\Http\Services;

use Illuminate\Http\Client\PendingRequest;

class GeometryDashProxyService
{
	protected string $base;

	public function __construct(
		protected ProxyService $proxy
	)
	{
		$this->base = rtrim(config('GeometryDashChinese.GeometryDashProxy.base'), '/');
	}

	public function instance(): PendingRequest
	{
		return $this->proxy->instance()
			->asForm()
			->withUserAgent(null)
			->retry(3);
	}

	public function sendPost(string $uri, array $data): string
	{
		return $this->instance()
			->post("$this->base$uri", $data)
			->body();
	}
}