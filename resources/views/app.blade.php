<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		{{-- <link rel="stylesheet" href="resources/css/app.css"> --}}
		
		<title>Laravel with Inertia</title>
		@vite
	</head>
	<body class="h-full bg-gray-100">
		@inertia
	</body>
</html>
