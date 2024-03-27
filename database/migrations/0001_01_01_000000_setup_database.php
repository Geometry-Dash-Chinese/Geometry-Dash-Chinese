<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
	protected array $schemas = ['gdcs', 'gdproxy', 'ngproxy'];

	public function up(): void
	{
		foreach ($this->schemas as $schema) {
			DB::unprepared("CREATE SCHEMA IF NOT EXISTS $schema;");
		}
	}

	public function down(): void
	{
		foreach ($this->schemas as $schema) {
			DB::unprepared("DROP SCHEMA IF EXISTS $schema CASCADE;");
		}
	}
};