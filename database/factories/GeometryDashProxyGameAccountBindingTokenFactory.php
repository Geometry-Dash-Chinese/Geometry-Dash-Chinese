<?php

namespace Database\Factories;

use App\Models\GeometryDashProxyGameAccountBindingToken;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GeometryDashProxyGameAccountBindingTokenFactory extends Factory
{
	protected $model = GeometryDashProxyGameAccountBindingToken::class;

	public function definition(): array
	{
		return [
			'user_id' => UserFactory::class,
			'token' => Str::random()
		];
	}
}