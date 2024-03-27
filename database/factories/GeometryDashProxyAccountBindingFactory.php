<?php

namespace Database\Factories;

use App\Models\GeometryDashProxyAccountBinding;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeometryDashProxyAccountBindingFactory extends Factory
{
	protected $model = GeometryDashProxyAccountBinding::class;

	public function definition(): array
	{
		return [
			'user_id' => UserFactory::class,
			'account_id' => $this->faker->randomNumber()
		];
	}
}