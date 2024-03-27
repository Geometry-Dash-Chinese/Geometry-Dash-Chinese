<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class GeometryDashProxyGameAccountDataBackup extends Model
{
	use HasFactory;

	protected $table = 'gdproxy.game_account_data_backups';

	public function user(): HasOneThrough
	{
		return $this->hasOneThrough(User::class, GeometryDashProxyGameAccountBinding::class, 'game_account_id', 'id', 'account_id', 'user_id');
	}

	public function binding(): HasOne
	{
		return $this->hasOne(GeometryDashProxyGameAccountBinding::class, 'game_account_id', 'account_id');
	}
}