<?php

namespace App\Http\Requests;

use App\Enums\GeometryDashAuthType;
use App\Enums\GeometryDashSecrets;
use App\Enums\GeometryDashVersions;

class GeometryDashAccountDataLoadRequest extends GeometryDashRequest
{
	public function rules(): array
	{
		return [
			...$this->withVersionRules(GeometryDashVersions::_22),
			...$this->withGuestIdentifierRules(),
			...$this->withAuthRules(GeometryDashAuthType::GJP2),
			...$this->withSecretRules(GeometryDashSecrets::ACCOUNT)
		];
	}
}