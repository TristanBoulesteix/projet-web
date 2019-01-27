<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{$title}}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="icon" href="https://ecole-ingenieurs.cesi.fr/wp-content/uploads/sites/5/2018/10/cropped-icone-cesi-ecole-ingenieurs-32x32.png">

<link rel="stylesheet" href="../css/main/main.css">
<link rel="stylesheet" href="../css/main/main_ipad.css">
<link rel="stylesheet" href="../css/main/main_phone.css">
<script src="../js/menu.js"></script>

	@yield('css')
</head>

<body onload="verify()">
	<header>
		<div id="banner">
			<h1> Bienvenue sur le site du BDE! </h1>
			@if (!$logged)
			<a id="connexion" href="{{route('login')}}">Connexion</a>
			@else
			<a id="hello" href="{{route('logout')}}">Bonjour&nbsp;{{ $firstName }}&nbsp;{{ $lastName }}&nbsp;!</a>
			@endif
		</div>

	</header>

<?php

$shopTemp = "Boutique";
$ideaTemp = "Boîte à Idées";
$eventTemp = "Évènement";

?>

	<aside class="sidebar">
		<a href='{!! route('home') !!}' id='logo'></a>
		<a class="side" href="{{url('shop')}}">{{$shopTemp}}</a>
		<a class="side" href="{{url('idea')}}">{{$ideaTemp}}</a>
		<a class="side" href="{{url('events')}}">{{$eventTemp}}</a>
		<div id="burger" onclick="showBurger();">

			<div></div>
			<div></div>
			<div></div>

		</div>

	</aside>

	<section id="menuBurger" class="sidebar" >
		<a href="{{url('shop')}}">{{$shopTemp}}</a>
		<a href="{{url('idea')}}">{{$ideaTemp}}</a>
		<a href="{{url('events')}}">{{$eventTemp}}</a>
	</section>

	<main>
		@yield('content')
	</main>
	<footer>

		<div id="cookie">

		</div>

		<a class="footlink" href=""> Mentions&nbsp;légales </a>
		<a class="footlink" href=""> Conditions&nbsp;générales&nbsp;de&nbsp;ventes </a>
		<a class="footlink" href=""> Politique&nbsp;de&nbsp;protections&nbsp;des&nbsp;données </a>
		<a class="footlink" href=""> Nous&nbsp;contacter </a>



	</footer>
	<script src="../js/boutonHello.js"></script>
	<script src="../js/cookies.js"></script>
</body>
</html>
