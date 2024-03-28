<?php

namespace App\Http\Controllers;

use App\Models\GeometryDashProxyGameAccountBindingToken;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Inertia\Inertia;

class GeometryDashProxyGameAccountBindingTokenController extends Controller
{
	public function create()
	{
		$alreadyHaveNoExpired = GeometryDashProxyGameAccountBindingToken::query()
				->where('user_id', Auth::id())
				->where('expired_at', '>', now())
				->count() > 0;

		if ($alreadyHaveNoExpired) {
			abort(403);
		}

		GeometryDashProxyGameAccountBindingToken::create([
			'user_id' => Auth::id(),
			'token' => Str::random(),
			'expired_at' => now()->addMinutes(10)
		]);

		return back();
	}

	public function renderPage()
	{
		return Inertia::render('GeometryDashProxy/Tools/Account/BindingToken', [
			'record' => GeometryDashProxyGameAccountBindingToken::query()
				->where('user_id', Auth::id())
				->where('expired_at', '>', now())
				->first()
		]);
	}
}