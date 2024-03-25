<?php

namespace App\Http\Requests;

use App\Enums\GeometryDash\AuthType;
use App\Enums\GeometryDash\Secrets;
use App\Enums\GeometryDash\Versions;
use Illuminate\Foundation\Http\FormRequest;

class GeometryDashGameRequest extends FormRequest
{
	public function withVersionRules(Versions $version): array
	{
		[$gameVersion, $binaryVersion] = explode(',', $version->value);

		return [
			'gameVersion' => [
				'required',
				"in:$gameVersion"
			],
			'binaryVersion' => [
				'required',
				"in:$binaryVersion"
			]
		];
	}

	public function withSecretRules(Secrets $secret): array
	{
		return [
			'secret' => [
				'required',
				"in:$secret->value"
			]
		];
	}

	public function withGuestIdentifierRules(): array
	{
		return [
			'uuid' => [
				'required',
				'string'
			],
			'udid' => [
				'required',
				'string'
			]
		];
	}

	public function withAuthRules(AuthType $authType): array
	{
		return [
			'accountID' => [
				'required',
				'integer'
			],
			...match ($authType) {
				AuthType::PASSWORD => [
					'password' => [
						'required',
						'string'
					]
				],
				AuthType::GJP => [
					'gjp' => [
						'required',
						'string'
					]
				],
				AuthType::GJP2 => [
					'gjp2' => [
						'required',
						'string'
					]
				]
			}
		];
	}
}