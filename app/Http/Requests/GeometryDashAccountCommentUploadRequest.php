<?php

namespace App\Http\Requests;

use App\Enums\GeometryDashAuthType;
use App\Enums\GeometryDashSecrets;
use App\Enums\GeometryDashVersions;

class GeometryDashAccountCommentUploadRequest extends GeometryDashRequest
{
	public function rules(): array
	{
		return [
			...$this->withVersionRules(GeometryDashVersions::_22),
			...$this->withGuestIdentifierRules(),
			...$this->withAuthRules(GeometryDashAuthType::GJP2),
			'userName' => [
				'required',
				'string'
			],
			'comment' => [
				'required',
				'string'
			],
			...$this->withSecretRules(GeometryDashSecrets::COMMON),
			'cType' => [
				'integer',
				'in:1'
			],
			'chk' => [
				'required',
				'string'
			]
		];
	}
}