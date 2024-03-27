<?php

namespace App\Http\Services;

use App\Enums\GeometryDashAccountDataType;
use App\Enums\GeometryDashSecrets;

class GeometryDashProxyAccountDataService
{
	public function __construct(
		protected GeometryDashProxyService $service
	)
	{

	}

	protected function getBase(int $accountID, GeometryDashAccountDataType $type): string
	{
		return $this->service->sendPost('/getAccountURL.php', [
			'accountID' => $accountID,
			'type' => $type->value,
			'secret' => GeometryDashSecrets::COMMON->value
		]);
	}

	public function saveToOfficial(array $data): string
	{
		return $this->service->instance()
			->post("{$this->getBase($data['accountID'], GeometryDashAccountDataType::SAVE)}/database/accounts/backupGJAccountNew.php", $data)
			->body();
	}

	public function loadFromOfficial(array $data): string
	{
		return $this->service->instance()
			->post("{$this->getBase($data['accountID'], GeometryDashAccountDataType::LOAD)}/database/accounts/syncGJAccountNew.php", $data)
			->body();
	}
}