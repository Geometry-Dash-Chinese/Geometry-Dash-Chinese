<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected string $table = 'jobs';
	protected string $table_batches = 'job_batches';
	protected string $table_failed_jobs = 'failed_jobs';

	public function up(): void
	{
		Schema::create($this->table, function (Blueprint $table) {
			$table->id();
			$table->string('queue')->index();
			$table->longText('payload');
			$table->unsignedTinyInteger('attempts');
			$table->unsignedInteger('reserved_at')->nullable();
			$table->unsignedInteger('available_at');
			$table->unsignedInteger('created_at');
		});

		Schema::create($this->table_batches, function (Blueprint $table) {
			$table->string('id')->primary();
			$table->string('name');
			$table->integer('total_jobs');
			$table->integer('pending_jobs');
			$table->integer('failed_jobs');
			$table->longText('failed_job_ids');
			$table->mediumText('options')->nullable();
			$table->integer('cancelled_at')->nullable();
			$table->integer('created_at');
			$table->integer('finished_at')->nullable();
		});

		Schema::create($this->table_failed_jobs, function (Blueprint $table) {
			$table->id();
			$table->string('uuid')->unique();
			$table->text('connection');
			$table->text('queue');
			$table->longText('payload');
			$table->longText('exception');
			$table->timestamp('failed_at')->useCurrent();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists($this->table);
		Schema::dropIfExists($this->table_batches);
		Schema::dropIfExists($this->table_failed_jobs);
	}
};