<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Panier</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ URL::asset('css/main/main.css') }}"
</head>
<body>
	<h1 style="color: red;">L'utilisateur {{ $reporter->first_name }} {{ $reporter->last_name }} a signalé l'article suivant :</h1>

	<ul>
		<li><b>Type de signalement :</b> {{ $request->type}} </li>
		<li><b>Id du signalement :</b> {{ $request->id }}</li>
	</ul>

</body>
</html>
