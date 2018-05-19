<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ayo Koding</title>
	</head>
	<body>
		<h1> Hello Kawan !!! </h1>
		<h2>{{ $blog }}</h2>

			@foreach($users as $user)
 				<li/>{{$user->username}} beralamat di	{{$user->alamat}}
			@endforeach
			<?php
				
			?>

	</body>
</html>
