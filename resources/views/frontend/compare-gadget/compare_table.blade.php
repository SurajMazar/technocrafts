<html>
	<head>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	</head>
	<body>
		<div class="container">
			@php
				echo '<pre>';
				echo print_r($first_laptop);
				echo '</pre>';
			@endphp
		</div>
	</body>
</html>