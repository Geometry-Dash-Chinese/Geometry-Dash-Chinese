<?php

namespace Database\Factories;

use App\Models\GeometryDashProxyGameAccountBinding;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeometryDashProxyGameAccountBindingFactory extends Factory
{
	protected $model = GeometryDashProxyGameAccountBinding::class;

	public function definition(): array
	{
		return [
			'user_id' => UserFactory::class,
			'account_id' => $this->faker->randomNumber()
		];
	}
}