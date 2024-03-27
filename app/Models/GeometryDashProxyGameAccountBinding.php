<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GeometryDashProxyGameAccountBinding extends Model
{
	use HasFactory;

	protected $table = 'gdproxy.game_account_bindings';

	public function data_backups(): HasMany
	{
		return $this->hasMany(GeometryDashProxyGameAccountDataBackup::class, 'account_id', 'game_account_id');
	}
}