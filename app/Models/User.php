<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model implements AuthenticatableContract, MustVerifyEmailContract
{
	use HasFactory, MustVerifyEmail, Authenticatable;

	protected $fillable = [
		'name',
		'email',
		'password'
	];

	protected $hidden = [
		'password'
	];
}