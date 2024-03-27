<?php

namespace App\Http\Services;

use App\Enums\GeometryDash\AccountDataType;
use App\Enums\GeometryDash\Secrets;

class GeometryDashProxyAccountDataService
{
	public function __construct(
		protected GeometryDashProxyService $service
	)
	{

	}

	protected function getBase(int $accountID, AccountDataType $type): string
	{
		return $this->service->sendPost('/getAccountURL.php', [
			'accountID' => $accountID,
			'type' => $type->value,
			'secret' => Secrets::COMMON->value
		]);
	}

	public function saveToOfficial(array $data): string
	{
		return $this->service->instance()
			->post("{$this->getBase($data['accountID'], AccountDataType::SAVE)}/database/accounts/backupGJAccountNew.php", $data)
			->body();
	}

	public function loadFromOfficial(array $data): string
	{
		return $this->service->instance()
			->post("{$this->getBase($data['accountID'], AccountDataType::LOAD)}/database/accounts/syncGJAccountNew.php", $data)
			->body();
	}
}