<!doctype html>
<html lang="{{ str_replace('_', '-', config('app.locale')) }}">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	@routes
	@vite('resources/scripts/main.ts')
	@inertiaHead
	<title>{{ config('app.name') }}</title>
</head>
<body>
@inertia
</body>
</html>