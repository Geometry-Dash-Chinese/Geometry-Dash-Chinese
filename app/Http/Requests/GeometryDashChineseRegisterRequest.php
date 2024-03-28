<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeometryDashChineseRegisterRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name' => [
				'required',
				Rule::unique(User::class)
			],
			'email' => [
				'required',
				'email',
				Rule::unique(User::class)
			],
			'password' => [
				'required',
				'confirmed'
			]
		];
	}
}