<?php

namespace App\Http\Services;

use App\Helpers\Command;
use App\Models\GeometryDashProxyGameAccountBinding;
use App\Models\GeometryDashProxyGameAccountBindingToken;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class GeometryDashProxyAccountCommentCommandService
{
	public function bind(Command $command): string
	{
		$accountID = Request::get('accountID');

		if (empty($accountID)) {
			return 'Missing accountID';
		}

		$token = Arr::get($command->parameters, 0);

		if (empty($token)) {
			return 'Missing token';
		}

		$record = GeometryDashProxyGameAccountBindingToken::query()
			->where('token', $token)
			->where('expired_at', '>', now())
			->first();

		if (empty($record)) {
			return 'Invalid token';
		}

		GeometryDashProxyGameAccountBinding::create([
			'user_id' => $record->user_id,
			'game_account_id' => $accountID
		]);

		$record->delete();
		return 'Success!';
	}
}