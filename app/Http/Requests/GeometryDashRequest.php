<?php

namespace App\Http\Requests;

use App\Enums\GeometryDashAuthType;
use App\Enums\GeometryDashSecrets;
use App\Enums\GeometryDashVersions;
use Illuminate\Foundation\Http\FormRequest;

class GeometryDashRequest extends FormRequest
{
	public function withVersionRules(GeometryDashVersions $version): array
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

	public function withSecretRules(GeometryDashSecrets $secret): array
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

	public function withAuthRules(GeometryDashAuthType $authType): array
	{
		return [
			'accountID' => [
				'required',
				'integer'
			],
			...match ($authType) {
				GeometryDashAuthType::PASSWORD => [
					'password' => [
						'required',
						'string'
					]
				],
				GeometryDashAuthType::GJP => [
					'gjp' => [
						'required',
						'string'
					]
				],
				GeometryDashAuthType::GJP2 => [
					'gjp2' => [
						'required',
						'string'
					]
				]
			}
		];
	}
}