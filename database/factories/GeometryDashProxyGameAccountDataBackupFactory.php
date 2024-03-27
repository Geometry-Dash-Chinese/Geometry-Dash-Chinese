<?php

namespace Database\Factories;

use App\Enums\GeometryDashSalts;
use App\Models\GeometryDashProxyGameAccountDataBackup;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeometryDashProxyGameAccountDataBackupFactory extends Factory
{
	protected $model = GeometryDashProxyGameAccountDataBackup::class;

	public function definition(): array
	{
		return [
			'account_id' => $this->faker->randomNumber(),
			'password' => sha1($this->faker->password . GeometryDashSalts::GJP2->value),
			'filename' => $this->faker->file
		];
	}
}