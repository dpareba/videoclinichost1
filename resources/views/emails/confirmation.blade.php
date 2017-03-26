<!DOCTYPE html>
<html>
<head>
	<title>Confirmation Email from Dilip Pareba</title>
</head>
<body>
	<h1>Dilip Pareba says THANK YOU for signing up.</h1>
	<p>
		You need to confirm your email address by clicking <a href='{{ url("register/confirm/{$user->token}") }}'>here</a>
	</p>
</body>
</html>