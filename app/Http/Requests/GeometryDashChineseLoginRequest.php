<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class GeometryDashChineseLoginRequest extends FormRequest
{
	public function rules(): array
	{
		return [
			'name' => [
				'required',
				Rule::exists(User::class)
			],
			'password' => [
				'required'
			],
			'remember' => [
				'required',
				'boolean'
			]
		];
	}
}