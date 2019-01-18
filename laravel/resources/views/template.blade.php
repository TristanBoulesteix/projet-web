<!DOCTYPE html>
<html>
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="icon" href="https://ecole-ingenieurs.cesi.fr/wp-content/uploads/sites/5/2018/10/cropped-icone-cesi-ecole-ingenieurs-32x32.png">
<link rel="stylesheet" type="text/css" href="./css/main.css">

	@yield('css')
</head>

<body>
	<header>
		<div id="banner">
		<h1> Bienvenue sur le site du BDE! </h1>
		@if (!$logged)
		<a id="connexion" href="/login">Connexion</a>
		@else
		<a id="hello" href="/logout">Bonjour Utilisateur!</a>
		@endif
		</div>

	</header>
	<aside class="sidebar">
	<div id="logo"></div>
		<a href="/shop">Boutique</a>
		<a href="/idea">Boîte à Idées</a>
		<a href="#/event">Évènement</a>
	</aside>
	<main>
		@yield('content')
	</main>
	<footer>
		<p id="legal"> Mentions Légales: <br> Voici les mentions légales.<br>À completer.</p>
	</footer>
	<script src="./js/boutonHello.js"></script>
</body>
</html>
