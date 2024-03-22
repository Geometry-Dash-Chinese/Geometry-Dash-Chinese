<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class GeometryDashChineseAuthController extends Controller
{
	public function __construct()
	{
		app(GeometryDashChineseController::class);
	}

	public function renderLogin()
	{
		return Inertia::render('GeometryDashChinese/Auth/Login');
	}

	public function login(Request $request)
	{
		$data = $request->validate([
			'name' => [
				'required',
				Rule::exists(User::class)
			],
			'password' => [
				'required'
			]
		]);

		if (!Auth::attempt($data)) {
			return back()
				->withErrors([
					'password' => '密码错误'
				]);
		}

		return Redirect::intended();
	}

	public function register(Request $request)
	{
		$data = $request->validate([
			'name' => [
				'required',
				Rule::unique(User::class)
			],
			'email' => [
				'required',
				'email',
				Rule::unique(User::class)
			],
			'password' => [
				'required',
				'confirmed'
			]
		]);

		Auth::login(
			User::create([
				'name' => $data['name'],
				'email' => $data['email'],
				'password' => bcrypt($data['password'])
			])
		);

		return Redirect::intended();
	}

	public function renderRegister()
	{
		return Inertia::render('GeometryDashChinese/Auth/Register');
	}

	public function logout()
	{
		Auth::logout();
		return back();
	}
}