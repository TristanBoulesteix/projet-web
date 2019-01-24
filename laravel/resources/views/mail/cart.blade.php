<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Panier</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<h1>Achats de la part de l&rsquo;utilisateur {{ $buyer->first_name }} {{ $buyer->last_name }}</h1>
	<p>Les id des articles sont :</p>
	<ul>
		@foreach ($kept as $article)
			<li>{{ $article->id }}</li>
		@endforeach
	</ul>
	<br>
	<?php
		$total = 0;
		foreach($kept as $article) {
			total += $article->price;
		}
	?>
	<p>Le prix total est de {{ $total }}</p>
	<br>
	<p>Vous devez le recontacter au <a href={!! HTML::mailto($buyer->email)></a>) !!}></a></p>
</body>
</html>
