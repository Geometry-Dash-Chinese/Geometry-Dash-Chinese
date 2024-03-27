<?php

namespace App\Http\Requests;

use App\Enums\GeometryDashAuthType;
use App\Enums\GeometryDashSecrets;
use App\Enums\GeometryDashVersions;

class GeometryDashAccountDataSaveRequest extends GeometryDashRequest
{
	public function rules(): array
	{
		return [
			...$this->withVersionRules(GeometryDashVersions::_22),
			...$this->withGuestIdentifierRules(),
			'saveData' => [
				'required',
				'string'
			],
			...$this->withAuthRules(GeometryDashAuthType::GJP2),
			...$this->withSecretRules(GeometryDashSecrets::ACCOUNT)
		];
	}
}