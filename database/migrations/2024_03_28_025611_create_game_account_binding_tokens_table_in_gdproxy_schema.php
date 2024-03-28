<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	protected string $table = 'gdproxy.game_account_binding_tokens';

	public function up(): void
	{
		Schema::create($this->table, function (Blueprint $table) {
			$table->id();
			$table->foreignIdFor(User::class);
			$table->string('token')->unique();
			$table->timestamp('expired_at');
			$table->timestamps();
		});
	}

	public function down(): void
	{
		Schema::dropIfExists($this->table);
	}
};