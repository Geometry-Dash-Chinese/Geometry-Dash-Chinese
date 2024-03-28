<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeometryDashProxyGameAccountBindingToken extends Model
{
	use HasFactory;

	protected $table = 'gdproxy.game_account_binding_tokens';

	protected $fillable = [
		'user_id',
		'token',
		'expired_at'
	];
}