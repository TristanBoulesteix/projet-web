<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
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
			<a id="hello" href="/logout">Bonjour&nbsp;{{ $firstName }}&nbsp;{{ $lastName }}&nbsp;!</a>
			@endif
		</div>

	</header>
	<aside class="sidebar">
		<a href='{!! route('home') !!}' id='logo'></a>
		<a href="/shop">Boutique</a>
		<a href="/idea">Boîte à Idées</a>
		<a href="/event">Évènement</a>
	</aside>
	<main>
		@yield('content')
	</main>
	<footer>
		<div id="cookie">
				<div id="cookieInjected">
					<div id="cookieWrapper">
						<h4 id="cookieHeader" >Ce site utilsie des cookies</h4>
						<p>Ce site utilise des cookies pour améliorer votre expérience utilisateur.En utilisant ce site internet, vous  acceptez notre politique concernant la consevation et l'utilisation des Cookies.<br>  </p>
							<div id="cookieButtons" >
								<div id="cookieAccept" onclick="accepter()">J'accepte <!-- disparition la section cookieInjeted et creation d'un cookie-->
								</div>
								<div id="cookieReject" href="">Je n'accepte pas <!--  mettre le lien vers la page d'acceuil.-->
								</div>
								<div id="cookieReadmore" href="">En savoir plus <!--  mettre le lien vers la page qui parle des coookies.-->
								</div>
							</div>
					</div>
				</div>
		</div>
		
		<a class="footlink" href=""> Mentions légales </a>
		<a class="footlink" href=""> Conditions générales de ventes </a>
		<a class="footlink" href=""> Politique de protections des données </a>

	</footer>
	<script src="./js/boutonHello.js"></script>
	<script src="./js/cookies.js"></script>
</body>
</html>
