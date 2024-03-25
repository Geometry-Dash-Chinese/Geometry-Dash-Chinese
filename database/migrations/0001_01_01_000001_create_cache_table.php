<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected string $table = 'cache';
	protected string $table_locks = 'cache_locks';

	public function up(): void
	{
		Schema::create($this->table, function (Blueprint $table) {
			$table->string('key')->primary();
			$table->mediumText('value');
			$table->integer('expiration');
		});

		Schema::create($this->table_locks, function (Blueprint $table) {
			$table->string('key')->primary();
			$table->string('owner');
			$table->integer('expiration');
		});
	}

	public function down(): void
	{
		Schema::dropIfExists($this->table);
		Schema::dropIfExists($this->table_locks);
	}
};