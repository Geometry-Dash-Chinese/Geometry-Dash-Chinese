<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected string $table = 'gdproxy.account_data';

	public function up(): void
	{
		Schema::create($this->table, function (Blueprint $table) {
			$table->id();
			$table->integer('account_id');
			$table->string('password');
			$table->string('filename');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists($this->table);
	}
};