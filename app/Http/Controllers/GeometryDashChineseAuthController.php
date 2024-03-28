<?php

namespace App\Http\Controllers;

use App\Http\Requests\GeometryDashChineseLoginRequest;
use App\Http\Requests\GeometryDashChineseRegisterRequest;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class GeometryDashChineseAuthController extends Controller
{

	public function login(GeometryDashChineseLoginRequest $request)
	{
		$data = $request->validated();

		if (!Auth::attempt(Arr::only($data, ['name', 'password']), $data['remember'])) {
			return back()
				->withErrors([
					'password' => '密码错误'
				]);
		}

		return Redirect::intended();
	}

	public function register(GeometryDashChineseRegisterRequest $request)
	{
		$data = $request->validated();

		Auth::login(
			User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => bcrypt($data['password'])
			])
		);

		return Redirect::intended();
	}

	public function logout()
	{
		Auth::logout();
		return back();
	}
}