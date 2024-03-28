<?php

namespace App\Http\Services;

use Illuminate\Http\Client\PendingRequest;

class GeometryDashProxyService
{
	protected string $base;

	public function __construct(
		protected ProxyService $proxyService
	)
	{
		$this->base = rtrim(config('GeometryDashChinese.GeometryDashProxy.base'), '/');
	}

	public function sendPost(string $uri, array $data): string
	{
		return $this->instance()
			->post("$this->base$uri", $data)
			->body();
	}

	public function instance(): PendingRequest
	{
		return $this->proxyService->instance()
			->asForm()
			->withUserAgent(null)
			->retry(3);
	}
}