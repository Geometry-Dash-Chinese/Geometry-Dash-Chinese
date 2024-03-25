<?php

namespace App\Http\Requests;

use App\Enums\GeometryDash\AuthType;
use App\Enums\GeometryDash\Secrets;
use App\Enums\GeometryDash\Versions;

class GeometryDashGameAccountDataLoadRequest extends GeometryDashGameRequest
{
	public function rules(): array
	{
		return [
			...$this->withVersionRules(Versions::_22),
			...$this->withGuestIdentifierRules(),
			...$this->withAuthRules(AuthType::GJP2),
			...$this->withSecretRules(Secrets::ACCOUNT)
		];
	}
}