<?php

namespace Database\Factories;

use App\Enums\GeometryDash\Salts;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeometryDashProxyGameAccountDataBackupFactory extends Factory
{
	public function definition(): array
	{
		return [
			'account_id' => $this->faker->randomNumber(),
			'password' => sha1($this->faker->password . Salts::GJP2->value),
			'filename' => $this->faker->file
		];
	}
}